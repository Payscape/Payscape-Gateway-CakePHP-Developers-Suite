
// calculate the # of days between two dates with strtotime

     $now = time(); // or your date as well
     $your_date = strtotime("2010-01-01");
     $datediff = $now - $your_date;
     echo floor($datediff/(60*60*24));