<!-- Name: Tyler Harbert -->

</main>
<footer>
    <p>&copy;
        <?php
        date_default_timezone_set("America/New_York");
        $startYear = 2006;
        $thisYear = date('Y');
        if ($startYear == $thisYear) {
            echo $startYear;
        } else {
            echo "$startYear" . '&ndash;' . "$thisYear";
        }
        ?>
        Tyler Harbert
    </p>
</footer>
</body>

</html>