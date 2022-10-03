<div class="row item-row">

    <?php    

    $i = 0;
    foreach ($imgArray as $img) {
        $i++;
        echo "<div class='col-3'><figure class='figure-item'>";
        echo '<img class="img-item" src="/img/' . basename($img) . '" alt="Immagine">';
        echo "</figure>";

        if((isset($_SESSION["logged"])) || ($_SESSION["logged"] == true)){
            echo '<button type="button" id="btn-' . basename($img) . '" onclick="eliminaImg(&#39;' . $id . '&#39;,';
            echo '&#39;' . basename($img) . '&#39;)">Elimina</button>';
        }
        echo '</div>';
    }

    ?>
</div>

<script>
    function eliminaImg(id, img) {

        $.ajax({
            url: "/del/img/" + id,
            type: "POST",
            data: { img: img },
            success: function (data) {
                console.log(data);
                location.reload();
            }

        });
    }
</script>