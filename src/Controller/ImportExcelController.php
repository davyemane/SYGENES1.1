<?php

namespace App\Controller;

use App\Entity\Field;
use App\Entity\Level;
use App\Entity\School;
use App\Entity\Student;
use App\Form\ExcelFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
class ImportExcelController extends AbstractController
{
    #[Route('/import', name: 'import')]
    public function importExcel(Request $request, SessionInterface $session,EntityManagerInterface $entityManager): Response
    {
        $schoolName = $session->get('school_name');
        $school = null;
    
        if ($schoolName) {
            // Trouver l'entité School correspondante
            $school = $entityManager->getRepository(School::class)->findOneBy(['name' => $schoolName]);
        }




        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier si l'utilisateur a le privilège "List Student"
        $hasListStudentPrivilege = false;
        foreach ($user->getRole() as $role) {
            foreach ($role->getPrivileges() as $privilege) {
                if ($privilege->getName() === 'Add Student') {
                    $hasListStudentPrivilege = true;
                    break 2;
                }
            }
        }
        if (!$hasListStudentPrivilege) {
            return $this->render('student/error.html.twig', ['message' => 'Access denied']);
        }        


        $form = $this->createForm(ExcelFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['file']->getData();

            if ($file) {
                $filePath = $file->getPathname();

                try {
                    $reader = IOFactory::createReader('Xlsx');
                    $spreadsheet = $reader->load($filePath);

                    $sheet = $spreadsheet->getActiveSheet();

                    foreach ($sheet->getRowIterator() as $row) {
                        $userData = [];
                        foreach ($row->getCellIterator() as $cell) {
                            $userData[] = $cell->getValue();
                        }

                        // Recherche ou création de l'entité Field
                        $fieldName = $userData[0]; // Assumption: Field name is in the first column of Excel
                        $field = $entityManager->getRepository(Field::class)->findOneBy(['code' => $fieldName]);

                        if (!$field) {
                            $field = new Field();
                            $field->setCode($fieldName);
                            // Définir d'autres propriétés de Field si nécessaire
                            $entityManager->persist($field);
                        }

                        // Recherche ou création de l'entité Level
                        $levelName = $userData[1]; // Assumption: Level name is in the second column of Excel
                        $level = $entityManager->getRepository(Level::class)->findOneBy(['name' => $levelName]);

                        if (!$level) {
                            $level = new Level();
                            $level->setName($levelName);
                            // Définir d'autres propriétés de Level si nécessaire
                            $entityManager->persist($level);
                        }

                        // Conversion de la date de naissance
                        $dateOfBirth = $this->convertToDate($userData[5]); // Assumption: Date of birth is in the sixth column of Excel

                        // Création d'un nouvel étudiant et assignation des entités Field et Level
                        $student = new Student();
                        $student->setField($field); // Assignation de l'entité Field
                        $student->setLevel($level); // Assignation de l'entité Level
                        $student->setName($userData[2]);
                        $student->setEmail($userData[3]);
                        $student->setPhoneNumber($userData[4]);
                        $student->setDateOfBirth($dateOfBirth); // Assignation de la date de naissance convertie
                        $student->setPlaceOfBirth($userData[6]);
                        $student->setSexe($userData[7]);
                        $student->setCni($userData[8]);
                        $student->setCountry($userData[9]);

                        $entityManager->persist($student);
                    }

                    $entityManager->flush();

                    $this->addFlash('success', 'Importation réussie et insertion dans la base de données des étudiants !');
                    return $this->redirectToRoute('import');
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors du téléchargement du fichier : ' . $e->getMessage());
                } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
                    $this->addFlash('error', 'Erreur lors de la lecture du fichier Excel : ' . $e->getMessage());
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'importation : ' . $e->getMessage());
                }
            }
        }

        return $this->render('student/import_excel.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'school'=>$school
        ]);
    }

    /**
     * Convertit une chaîne de caractères en objet DateTimeInterface.
     *
     * @param string|null $dateString La chaîne de caractères représentant la date.
     * @return \DateTimeInterface|null L'objet DateTimeInterface ou null si la chaîne est vide.
     * @throws \Exception Si la chaîne de caractères ne peut pas être convertie en objet DateTimeInterface.
     */
    private function convertToDate(?string $dateString): ?\DateTimeInterface
    {
        if (!$dateString) {
            return null;
        }
    
        try {
            $date = \DateTime::createFromFormat('d/m/y', $dateString);
            
            if (!$date) {
                return null; // Retourne null si la conversion échoue
            }
    
            return $date->setTime(0, 0);
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la conversion de la date : " . $e->getMessage());
        }
    }
    }
