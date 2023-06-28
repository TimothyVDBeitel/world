<?php
use yii\helpers\Html;

echo "Timothy van den Beitel";
echo "<table>";
echo "<tr><td><h4><b>Naam</b></h4></td>";
echo "<td><h4><b>Hoofdstad</b></h4></td>";
echo "<td><h4><b>Oppervlakte</b></h4></td>";
echo "<td style='padding-left: 20px;'><h4><b>Taal</b></h4></td></tr>";

foreach ($countries as $country) {
    echo "<tr><td>".$country->Name."</td>";
    echo "<td valign='top'>".Html::a($country->hoofdstad->Name,['/city/view', 'ID' => $country->hoofdstad->ID])."</td>";
    echo "<td style='text-align:right;'>".number_format($country->SurfaceArea, 0, ',', ' ')."</td>";

    $countryLanguages = $country->countrylanguages;
    usort($countryLanguages, function($a, $b) {
        return $b->Percentage <=> $a->Percentage;
    });

    foreach ($countryLanguages as $taal) {
        echo "<td style='padding-left: 20px; vertical-align: top;'>".$taal->Language." (".$taal->Percentage."%)</td>";
        echo "</tr><tr><td></td><td></td><td></td>";
    }
    echo "</tr>";
}

echo "</table>";
?>
