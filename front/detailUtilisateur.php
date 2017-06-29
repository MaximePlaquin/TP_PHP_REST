<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="styleLogin.css">
</head>

<body>
    <div class="login">
        <div class="login-form">
            <div class="login-screen">
                <div class="control-group">
                    <input type="text" class="login-field" placeholder="Pseudo" id="login-name">
                    <label class="login-field-icon fui-user" for="login-name">Prenom</label>
                </div>

                <div class="control-group">
                    <input type="text" class="login-field" placeholder="prenom" id="login-name1">
                    <label class="login-field-icon fui-lock" for="login-pass">nom</label>
                </div>
                <div class="control-group">
                    <input type="text" class="login-field" placeholder="pseudo" id="login-pseudo">
                    <label class="login-field-icon fui-lock" for="login-pass">Pseudo</label>
                </div>
                <div class="control-group">
                    <input type="text" class="login-field" placeholder="mdp" id="login-pass">
                    <label class="login-field-icon fui-lock" for="login-pass">Mdp</label>
                </div>
                <input type="" class="btn btn-primary btn-large btn-block" value="Annuler" onclick='window.location.href = "gestionUtilisateur.html"' />
                <input type="submit" class="btn btn-primary btn-large btn-block" value="supprimer" onclick="deleteUser()" />
                <input type="submit" class="btn btn-primary btn-large btn-block" value="Valider les changements" onclick="updateUser()" />
            </div>
        </div>
    </div>
    <script src="jquery-3.2.1.min.js"></script>
    <script>
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
            function deleteUser(){
                $.ajax({
                    url: "../back/rest.php?/users/"+getUrlParameter('id'),
                    type: "DELETE",
                    success: function (data) {
                        alert('utilisateur supprimé !');
                        window.location.href = "gestionUtilisateur.html";
                    },
                    error: function (resultat, statut, erreur) {
                        console.log('erreur');
                    }
                });
            }
               function updateUser(){
                $.ajax({
                    url: "../back/rest.php?/users/"+getUrlParameter('id'),
                    type: "PUT",
                    success: function (data) {
                        alert('utilisateur mis à jour !');
                        window.location.href = "gestionUtilisateur.html";
                    },
                    error: function (resultat, statut, erreur) {
                        console.log('erreur');
                    }
                });
            }
        $(document).ready(function () {
            $.ajax({
                url: "../back/rest.php?/users/"+getUrlParameter('id'),
                type: "GET",
                success: function (data) {
                    var dataJson = JSON.parse(data);
                    $(dataJson).each(function(index, element){
                        $('#login-name1').val(element['prenom']);
                        $('#login-name').val(element['nom']);
                        $('#login-pseudo').val(element['pseudo']);
                        $('#login-pass').val(element['mdp']);
                    });
                },
                error: function (resultat, statut, erreur) {
                    console.log('erreur');
                }
            });

        });

    </script>
</body>

</html>