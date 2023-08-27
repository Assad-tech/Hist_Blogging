<?php
        ob_start();
        require_once 'fpdf/fpdf.php';
        $cvObj = new FPDF();

        $cvObj->AddPage("P","A4");
        // Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]]);
        $cvObj->Image($destination,150,10,50,50);

        // SetFont(string family [, string style [, float size]])
        $cvObj->setfont('Times','B',30);
        
        // Ln([float h])
        $cvObj->Ln(5);
        
        //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
        $cvObj->cell(70,12,$first_name,'',1,'L');
        
        // SetTextColor(int r [, int g, int b])
        $cvObj->SetTextColor(237, 150, 19);
        $cvObj->cell(70,11,$last_name,'',2,'L');
        
        // Other Details
        $cvObj->Ln(2);
        $cvObj->setfont('Times','',16);
        $cvObj->cell(70,5,'Other Details:','',1,'L');
            
        $cvObj->Ln(1);
        $cvObj->setfont('Arial','',11);
        $cvObj->SetTextColor(13, 13, 13);
        // MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
        $cvObj->MultiCell(110,5,"Role id: 2",'');
        $cvObj->MultiCell(110,5,"Email:".$email,'');
        $cvObj->MultiCell(110,5,"Password:".$password,'');
        $cvObj->MultiCell(110,5,"Gender:".$gender,'');
        $cvObj->MultiCell(110,5,"Date of Birth:".$date_of_birth,'');
        $cvObj->MultiCell(110,5,"Addess:".$address,'');
        $cvObj->MultiCell(110,5,"Request Status: pending",'');
        
        //Some Lines
        $cvObj->Ln(2);
        $cvObj->SetTextColor(237, 150, 19);
        $cvObj->setfont('Times','',16);
        // $cvObj->Line(10,61,200,61);
        $cvObj->Line(10,225,200,225);
        $cvObj->cell(70,5,'Please Note:','',1);

        $cvObj->Ln(3);
        $cvObj->setfont('Arial','',12);
        $cvObj->SetTextColor(13, 13, 13);
        $cvObj->Cell(100,5,'Please Goto to your email check further deatails',0,1,);

        $cvObj->output("D",time()."_".$first_name."_profile.pdf");
        // $cvObj->close();
        ob_end_flush();
?>