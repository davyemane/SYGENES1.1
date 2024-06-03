<?php

namespace App\Controller;

use App\Entity\ExcelData;
use App\Entity\Student;
use App\Entity\User;
use App\Form\ExcelFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

;
#[Route('/admin')]


class ImportExcelController extends AbstractController
{
    #[Route('/import', name: 'import')]

    public function importExcel(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(ExcelFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['file']->getData();

            if ($file) {
                $filePath = $file->getClientOriginalName(); // Chemin vers le fichier Excel temporairement stocké
                
                $reader = IOFactory::createReader('Xlsx'); // Sélectionne le type de fichier
                $spreadsheet = $reader->load($filePath); // Charge le fichier Excel

                $sheet = $spreadsheet->getActiveSheet(); // Récupère la première feuille du fichier Excel

                foreach ($sheet->getRowIterator() as $index => $row) {
                    $userData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $userData[] = $cell->getValue(); // Récupère la valeur de chaque cellule
                    }

                    $student = new Student();
                    $student->setName($userData[0]);
                    $student->setEmail($userData[1]);
                    $student->setPhoneNumber($userData[2]);

                    $entityManager->persist($student);
                }

                $entityManager->flush(); // Enregistrer les utilisateurs dans la base de données

                return new Response('Importation réussie et insertion dans la base de données des étudiants !');
            }
        }

        return $this->render('student/import_excel.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    }
