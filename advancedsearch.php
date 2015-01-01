<?php
require ("header.php");
?>

<big><big>Search Console</big><br>
<br>

  <table style="text-align: left; width: 100%;" border="0"
 cellpadding="2" cellspacing="2">
    <tbody>

      <tr>
        <td> <form method="post" action="printorder.php">Print WO# (unique XX, range XX-XX, discrete XX, XX):<BR>
        <input name="printorderhistory" id="printorderhistory" type="checkbox">include order history <BR>
        <input name="converttoservicereport" id="converttoservicereport" type="checkbox">convert to service report <BR>
        <input name="converttopdf" id="converttopdf" type="checkbox">convert to pdf (only valid for one order)<BR>
        Add the following text on the first page of the pdf document:<BR />
        <textarea rows="2" cols="60" name="add_text">Please see service reports for -fault description here- on the following pages.</textarea><BR>
        <input name="printorder" id="printorder" type="text">
        <input name="printorderbutton" id="printorder" type="submit"></form></td>
      </tr>
      <tr>
        <td><a href = "advancedsearchresults.php?q=2">Yearly Dark Jobs</a></td>
      </tr>
      <tr>
        <td><form method="post" action="advancedsearchresults.php?q=3">WO Short description contains:<BR>
        <input name="wosummary" id="wosummary" type="text"><input name="wosummarybutton" id="wosummarybutton" type="submit"></form></td>
        
        </td>
      </tr>
      <tr>
        <td><a href = "advancedsearchresults.php?q=1"> List of all open orders</a> (organized by user)</td>
      </tr>
      <tr>
        <td>
        
        <?php
        //two date boxes to input the start and end dates of the report. send to report.php
        
        echo "<form method=\"post\" action=\"report.php\">
            Reporting area:<BR>
            Start date: <input name =\"startdate\" type = \"text\" id =\"datepicker\"><BR>
            End date: <input name =\"enddate\" type = \"text\" id =\"datepicker2\"><BR>
            <input name=\"reportbutton\" id=\"reportbutton\" type=\"submit\">
            </form>";
            
        ?>
        
        </td>
      </tr>
    </tbody>
  </table>
</form>


<?php
require ("footer.php");
?>
