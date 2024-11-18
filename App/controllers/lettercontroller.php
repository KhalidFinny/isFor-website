<?php
require_once '../vendor/autoload.php';
require_once '../config/database.php';

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

class LetterController {
    private $db;
    private $templatesPath;

    public function __construct($db) {
        $this->db = $db;
        $this->templatesPath = __DIR__ . '/../templates/letters/';
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'submit';
        
        if ($action === 'preview') {
            $this->previewLetter($_POST);
        } else {
            $this->submitLetter($_POST);
        }
    }

    private function previewLetter($data) {
        try {
            $template = $this->getTemplate('research_recommendation');
            $processedDoc = $this->processTemplate($template, $data);
            $pdf = $this->convertToPDF($processedDoc);
            
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="preview.pdf"');
            echo $pdf;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    private function processTemplate($templatePath, $data) {
        $template = new TemplateProcessor($templatePath);
        
        // Map form fields to template variables
        $template->setValue('research_title', $data['researchTitle']);
        $template->setValue('lead_researcher', $data['leadResearcher']);
        $template->setValue('research_scheme', $data['researchScheme']);
        $template->setValue('research_center', $data['researchCenter']);
        $template->setValue('research_topic', $data['researchTopic']);
        $template->setValue('current_date', date('d F Y'));
        
        // Save temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'letter_');
        $template->saveAs($tempFile);
        
        return $tempFile;
    }

    // ... rest of the controller methods remain the same
}

$controller = new LetterController($db);
$controller->handleRequest(); 