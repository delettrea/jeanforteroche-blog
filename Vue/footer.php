</div>
<footer>
    <p>2017 <a href="">Jean Forteroche</a> - <a href="">Plan du site</a> - <a href="">Mentions légales</a> -
    <?php
    if(empty($_SESSION['authorization_user'])) {
        echo "<a class='' href='index.php?action=login'>Espace d'administration</a>";
    }
    else{
        echo 'Bievenue sur le site '.$_SESSION['login'].' - <a class="" href="index.php?action=logout">Se déconnecter</a>';
    }?>
    </p>

</footer>
</body>
<script>


</script>

</html>