<?php 
$rows   = 24;
$column = 32;
$suhu = 10;

$table = "<table>";
for ($i=0; $i < $rows ; $i++) { 
    $table .= ' <tr class="row-mlx">';
    $table .= "\r\n";
    for ($u=0; $u < $column ; $u++) { 
        $table .= '     <td class="grid-mlx" id="row_'.$i.'_grid_'.$u.'">';
        $table .= "\r\n";
        if ($i<=3) {
            $suhu = rand(10,15);
        }else if ($i>=4 && $u<=4) {
            $suhu = rand(10,15);
        }else if ($i>=4 && $u>=27) {
            $suhu = rand(10,15);
        }else if ($i>=20) {
            $suhu = rand(10,15);
        }else{
            $suhu = rand(37,38);
        }
        $table .= '         <span class="grid_temp" id="row_'.$i.'_grid_'.$u.'_temp">'.$suhu.'&#176;</span>';
        $table .= "\r\n";
        $table .= '     </td>';
        $table .= "\r\n";
    }
    $table .= ' </tr>';
    $table .= "\r\n";
}
$table .= "</table>";
$table .= "\r\n";

echo $table;
die();
?>
<!--
<table>
    <tr class="row-mlx">
        <td class="grid-mlx" id="row_0_grid_0">
            <span class="grid_temp" id="row_0_grid_0_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_1">
            <span class="grid_temp" id="row_0_grid_1_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_2">
            <span class="grid_temp" id="row_0_grid_2_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_3">
            <span class="grid_temp" id="row_0_grid_3_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_4">
            <span class="grid_temp" id="row_0_grid_4_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_5">
            <span class="grid_temp" id="row_0_grid_5_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_6">
            <span class="grid_temp" id="row_0_grid_6_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_7">
            <span class="grid_temp" id="row_0_grid_7_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_8">
            <span class="grid_temp" id="row_0_grid_8_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_9">
            <span class="grid_temp" id="row_0_grid_9_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_10">
            <span class="grid_temp" id="row_0_grid_10_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_11">
            <span class="grid_temp" id="row_0_grid_11_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_12">
            <span class="grid_temp" id="row_0_grid_12_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_13">
            <span class="grid_temp" id="row_0_grid_13_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_14">
            <span class="grid_temp" id="row_0_grid_14_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_0_grid_15">
            <span class="grid_temp" id="row_0_grid_15_temp">0&#176;</span>
        </td>
    </tr>

    <tr class="row-mlx">
        <td class="grid-mlx" id="row_1_grid_0">
            <span class="grid_temp" id="row_1_grid_0_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_1">
            <span class="grid_temp" id="row_1_grid_1_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_2">
            <span class="grid_temp" id="row_1_grid_2_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_3">
            <span class="grid_temp" id="row_1_grid_3_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_4">
            <span class="grid_temp" id="row_1_grid_4_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_5">
            <span class="grid_temp" id="row_1_grid_5_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_6">
            <span class="grid_temp" id="row_1_grid_6_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_7">
            <span class="grid_temp" id="row_1_grid_7_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_8">
            <span class="grid_temp" id="row_1_grid_8_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_9">
            <span class="grid_temp" id="row_1_grid_9_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_10">
            <span class="grid_temp" id="row_1_grid_10_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_11">
            <span class="grid_temp" id="row_1_grid_11_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_12">
            <span class="grid_temp" id="row_1_grid_12_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_13">
            <span class="grid_temp" id="row_1_grid_13_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_14">
            <span class="grid_temp" id="row_1_grid_14_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_1_grid_15">
            <span class="grid_temp" id="row_1_grid_15_temp">0&#176;</span>
        </td>
    </tr>

    <tr class="row-mlx" >
        <td class="grid-mlx" id="row_2_grid_0">
            <span class="grid_temp" id="row_2_grid_0_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_1">
            <span class="grid_temp" id="row_2_grid_1_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_2">
            <span class="grid_temp" id="row_2_grid_2_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_3">
            <span class="grid_temp" id="row_2_grid_3_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_4">
            <span class="grid_temp" id="row_2_grid_4_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_5">
            <span class="grid_temp" id="row_2_grid_5_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_6">
            <span class="grid_temp" id="row_2_grid_6_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_7">
            <span class="grid_temp" id="row_2_grid_7_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_8">
            <span class="grid_temp" id="row_2_grid_8_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_9">
            <span class="grid_temp" id="row_2_grid_9_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_10">
            <span class="grid_temp" id="row_2_grid_10_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_11">
            <span class="grid_temp" id="row_2_grid_11_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_12">
            <span class="grid_temp" id="row_2_grid_12_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_13">
            <span class="grid_temp" id="row_2_grid_13_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_14">
            <span class="grid_temp" id="row_2_grid_14_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_2_grid_15">
            <span class="grid_temp" id="row_2_grid_15_temp">0&#176;</span>
        </td>
    </tr>

    <tr class="row-mlx" >
        <td class="grid-mlx" id="row_3_grid_0">
            <span class="grid_temp" id="row_3_grid_0_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_1">
            <span class="grid_temp" id="row_3_grid_1_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_2">
            <span class="grid_temp" id="row_3_grid_2_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_3">
            <span class="grid_temp" id="row_3_grid_3_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_4">
            <span class="grid_temp" id="row_3_grid_4_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_5">
            <span class="grid_temp" id="row_3_grid_5_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_6">
            <span class="grid_temp" id="row_3_grid_6_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_7">
            <span class="grid_temp" id="row_3_grid_7_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_8">
            <span class="grid_temp" id="row_3_grid_8_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_9">
            <span class="grid_temp" id="row_3_grid_9_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_10">
            <span class="grid_temp" id="row_3_grid_10_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_11">
            <span class="grid_temp" id="row_3_grid_11_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_12">
            <span class="grid_temp" id="row_3_grid_12_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_13">
            <span class="grid_temp" id="row_3_grid_13_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_14">
            <span class="grid_temp" id="row_3_grid_14_temp">0&#176;</span>
        </td>
        <td class="grid-mlx" id="row_3_grid_15">
            <span class="grid_temp" id="row_3_grid_15_temp">0&#176;</span>
        </td>
    </tr>
</table>