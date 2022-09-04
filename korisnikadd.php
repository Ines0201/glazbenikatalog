<?php include("header.php")?>

    <section class="admin-korisnici" style="min-height: 200px;">
        <?php if($action == 'add'):?>
            <form method="post">
                <input class="form-add" value"" type="text" name="id_korisnika" placeholder="ID korisnika">
                <input class="form-add" value"" type="text" name="tip_korisnika" placeholder="Tip korisnika">
                <input class="form-add" value"" type="text" name="medijska_kuca" placeholder="Medijska kuća">
                <input class="form-add" value"" type="text" name="korime" placeholder="Korime">
                <input class="form-add" value"" type="text" name="ime" placeholder="Ime">
                <input class="form-add" value"" type="text" name="prezime" placeholder="Prezime">
                <input class="form-add" value"" type="eamil" name="email" placeholder="Email">
                <input class="form-add" value"" type="password" name="lozinka" placeholder="Lozinka">
                <button class="btn bg-orange">Kreiraj</button>
        <?php elseif($action == 'edit'):?>
            edit
        <?php elseif($action == 'delete'):?>
            delete 
        <?php else:?>

        <h2>Korisnici <button class="float-end">Dodaj novog korisnika</button></h2>

        <table class="tablica">
            <tr>
                <th>ID korisnika</th>
                <th>Tip korisnika</th>
                <th>Medijska kuća</th>
                <th>Korime</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Lozinka</th>
            </tr>
            <tr>
                <th>ID korisnika</th>
                <th>Tip korisnika</th>
                <th>Medijska kuća</th>
                <th>Korime</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Lozinka</th>
            </tr>
        </table>

    <?php endif;?>
        </section>

<?php include("footer.php")?>