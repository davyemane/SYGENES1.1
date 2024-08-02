<?php

namespace App\Controller;

use App\Entity\Field;
use App\Entity\Level;
use App\Entity\Student;
use App\Form\ExcelFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin')]
class ImportExcelController extends AbstractController
{
    #[Route('/import', name: 'import')]
    public function importExcel(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
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

                    foreach ($sheet->getRowIterator(2) as $row) {  // Start from row 2 to skip header
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false);
                        $userData = [];
                        foreach ($cellIterator as $cell) {
                            $userData[] = $cell->getValue();
                        }

                        // Recherche de l'entité Field
                        $fieldCode = $userData[0];
                        $field = $entityManager->getRepository(Field::class)->findOneBy(['code' => $fieldCode]);

                        if (!$field) {
                            $this->addFlash('warning', "La filière avec le code '$fieldCode' n'existe pas dans la base de données.");
                            continue;  // Skip this row and continue with the next
                        }

                        // Recherche de l'entité Level
                        $levelName = $userData[1];
                        $level = $entityManager->getRepository(Level::class)->findOneBy([
                            'name' => $levelName,
                            'field' => $field
                        ]);

                        if (!$level) {
                            $this->addFlash('warning', "Le niveau '$levelName' n'existe pas pour la filière '$fieldCode'.");
                            continue;  // Skip this row and continue with the next
                        }

                        // Conversion de la date de naissance
                        $dateOfBirth = $this->convertToDate($userData[5]);

                        // Création d'un nouvel étudiant et assignation des entités Field et Level
                        $student = new Student();
                        $student->setField($field);
                        $student->setLevel($level);
                        $student->setName($userData[2]);
                        $student->setEmail($userData[3]);
                        $student->setPhoneNumber($userData[4]);
                        $student->setDateOfBirth($dateOfBirth);
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
        ]);
    }

    private function convertToDate(?string $dateString): ?\DateTimeInterface
    {
        if (!$dateString) {
            return null;
        }
    
        try {
            $date = \DateTime::createFromFormat('d/m/y', $dateString);
            
            if (!$date) {
                return null;
            }
    
            return $date->setTime(0, 0);
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la conversion de la date : " . $e->getMessage());
        }
    }
}