<?php

namespace App\Controller;

use App\Entity\EC;
use App\Repository\ECRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('teacher')]
class RespECController extends AbstractController
{
    #[Route('/admin/respec', name: 'respec_dashboard')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('admin_dashboard/teacher_dashboard.html.twig', [
            'controller_name' => 'RespECController',
            'user' => $user
        ]);
    }
    #[Route('/', name: 'teacher_ec_dashboard')]
    public function home(ECRepository $ecRepository): Response
    {
        $user = $this->getUser();
        $teacher = $user->getTeacher();
        
        if (!$teacher) {
            throw $this->createAccessDeniedException('You must be a teacher to access this page.');
        }
        
        $ecs = $teacher->getEcs();
        
        $subjectsHandled = $ecs->map(function (EC $ec) {
            return [
                'id'=> $ec->getId(),
                'name' => $ec->getName(),
                'code' => $ec->getCodeEc(),
                'studentsCount' => count($ec->getNoteCcTps()),
            ];
        })->toArray();

        
        $ue = null;
        if (!$ecs->isEmpty()) {
            $firstEc = $ecs->first();
            $ue = $firstEc->getUe();
        }
        
        $passedStudents = $ecRepository->countStudentsByTeacherAndStatus($teacher, 'passed');
        $failedStudents = $ecRepository->countStudentsByTeacherAndStatus($teacher, 'failed');
        $registeredStudents = $ecRepository->countStudentsByTeacher($teacher);
        
        $assistants = []; 
        $i =0;
        foreach ($teacher->getAssistantTeachers() as $assistant) {
            $assistants[$i]= $assistant;
            $i +=1; 
        }
        
        return $this->render('admin_dashboard/teacher_dashboard.html.twig', [
            'ecs' => $ecs,
            'subjectsHandled' => $subjectsHandled,
            'passedStudents' => $passedStudents,
            'failedStudents' => $failedStudents,
            'registeredStudents' => $registeredStudents,
            'assistants' => $assistants,
            'user' => $user,
            'ue' => $ue
        ]);
    }
}
