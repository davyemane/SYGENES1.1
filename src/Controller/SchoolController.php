<?php

namespace App\Controller;

use App\Entity\School;
use App\Form\SchoolType;
use App\Repository\RespSchoolRepository;
use App\Repository\SchoolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/super_admin')]
#[IsGranted('ROLE_SUPER_ADMIN')]
class SchoolController extends AbstractController
{
    #[Route('/school', name: 'app_school')]
    public function index(): Response
    {
        return $this->render('school/index.html.twig', [
            'controller_name' => 'SchoolController',
        ]);
    }

    #[Route('/new_school/{id?0}', name: 'school_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, SessionInterface $session, int $id = 0): Response
    {
        if ($id > 0) {
            $school = $entityManager->getRepository(School::class)->find($id);
            if (!$school) {
                throw $this->createNotFoundException('École non trouvée');
            }
        } else {
            $school = new School();
        }
    
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $logoFile = $form->get('logo')->getData();
    
            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($school->getName());
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logoFile->guessExtension();
    
                try {
                    $logoFile->move(
                        $this->getParameter('logo_directory'),
                        $newFilename
                    );
                    $school->setLogo($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors du téléchargement du fichier.');
                    return $this->redirectToRoute('school_new', ['id' => $id]);
                }
            }
    
            if (!$school->getId()) {
                $entityManager->persist($school);
            }
            $entityManager->flush();
            
            // Enregistrez le nom de l'école dans la session
            $session->set('school_name', $school->getName());
    
            $this->addFlash('success', $id > 0 ? 'L\'école a été mise à jour avec succès.' : 'L\'école a été créée avec succès.');
            return $this->redirectToRoute('school_new');
        }
    
        return $this->render('school/new.html.twig', [
            'school' => $school,
            'form' => $form,
            'isNew' => $id === 0
        ]);
    }




    // #[Route('/list_school', name: 'list_school')]
    // public function list(SchoolRepository $schoolRepository): Response
    // {
    //     $schools = $schoolRepository->findAll();
    
    //     return $this->render('super_admin_dashboard/index.html.twig', [
    //         'school' => $schools,
    //     ]);
    // }
    
    #[Route('/delete_school/{id}', name: 'delete_school')]
    public function deleteSchool(School $school, EntityManagerInterface $entityManager): Response
    {
        try {
            $entityManager->beginTransaction();
    
            // 1. Supprimer les champs associés
            foreach ($school->getFields() as $field) {
                $entityManager->remove($field);
            }
    
            // 2. Supprimer les rôles associés
            foreach ($school->getRoles() as $role) {
                $entityManager->remove($role);
            }
    
            // 3. Supprimer les schémas de couleurs associés
            foreach ($school->getColors() as $color) {
                $entityManager->remove($color);
            }
    
            // 4. Gérer la relation avec RespSchool
            $respSchool = $school->getRespSchool();
            if ($respSchool) {
                $respSchool->setSchool(null);
                $entityManager->remove($respSchool);
            }
    
            // 5. Supprimer l'école
            $entityManager->remove($school);
    
            // 6. Appliquer les changements
            $entityManager->flush();
            $entityManager->commit();
    
            $this->addFlash('success', 'L\'école a été supprimée avec succès.');
        } catch (\Exception $e) {
            $entityManager->rollback();
            $this->addFlash('error', 'Une erreur est survenue lors de la suppression : ' . $e->getMessage());
        }
    
        return $this->redirectToRoute('admin_dashboard'); // Assurez-vous que cette route existe
    }

    #[Route('/dashboard', name: 'super_admin_dashboard')]
public function dashboard(SchoolRepository $schoolRepository, RespSchoolRepository $respSchoolRepository): Response
{
    $user = $this->getUser();
    $schools = $schoolRepository->findAll();
    $respSchools = $respSchoolRepository->findAll();

    return $this->render('super_admin_dashboard/index.html.twig', [
        'school' => $schools,
        'resp_schools' => $respSchools,
        'user'=>$user
    ]);
}
}
