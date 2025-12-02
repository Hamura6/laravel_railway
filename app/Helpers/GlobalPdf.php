<?php

namespace App\Helpers;

use FPDF;

class GlobalPdf extends FPDF
{
    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        return parent::__construct($orientation, $unit, $size);
    }

    public function Header()
    {
        // Logo (derecha)
        $this->Image(public_path('image/user.png'), 165, 8, 30);

        // Nombre institución
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(0, 0, 0);
        $this->SetXY(10, 12);
        $this->Cell(0, 10, utf8_decode("ILUSTRE COLEGIO DE ABOGADOS"), 0, 1, 'L');

        // Línea negra
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.8);
        $this->Line(10, 25, 200, 25);

        // Línea roja debajo
        $this->SetDrawColor(200, 0, 0);
        $this->SetLineWidth(0.8);
        $this->Line(10, 28, 200, 28);

        $this->Ln(15);

        // Marca de agua (gris claro)
        $this->SetFont('Arial', 'B', 50);
        $this->SetTextColor(235, 235, 235);
        $this->RotatedText(35, 200, utf8_decode("ILUSTRE COLEGIO DE ABOGADOS"), 45);
    }

    public function Footer()
    {
        // Fondo rojo
        $this->SetY(-30);
        $this->SetFillColor(200, 0, 0);
        $this->Rect(0, $this->GetY(), 210, 30, 'F');

        // Texto blanco dentro del footer
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', '', 9);

        $this->SetXY(10, -25);
        $this->Cell(0, 5, utf8_decode("Tel: 78945612     •     Email: info@colegio.bo     •     Dirección: Av. Siempre Viva 123"), 0, 1, 'L');

        // Web abajo
        $this->SetXY(10, -15);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, utf8_decode("www.ilustrecolegiobo.org"), 0, 1, 'L');
    }

    // Función para rotar texto (marca de agua)
    public function RotatedText($x, $y, $txt, $angle)
    {
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }
    protected $angle = 0;

    function Rotate($angle, $x = -1, $y = -1)
    {
        if ($x == -1) {
            $x = $this->x;
        }
        if ($y == -1) {
            $y = $this->y;
        }
        if ($this->angle != 0) {
            $this->_out('Q');
        }
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf(
                'q %.5F %.5F %.5F %.5F %.5F %.5F cm 1 0 0 1 %.5F %.5F cm',
                $c,
                $s,
                -$s,
                $c,
                $cx,
                $cy,
                -$cx,
                -$cy
            ));
        }
    }

    function _endpage()
    {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }
}
