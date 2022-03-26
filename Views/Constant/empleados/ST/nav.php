<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <img src="<?=PATH?>Assets/img/logo.PNG" alt="" width="150" height="50" class="d-inline-block align-text-top">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?c=products&a=showst">Inventario
                        General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?c=products&a=showstall">Santa Tecla</a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?c=worker&a=worker">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?c=family&a=family">Familia</a>
                    </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-archive-fill"></i> Stock
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?=PATH?>?c=products&a=stokessst">San Salvador</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>?c=products&a=stokelost">Lourdes</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>?c=products&a=stokeopst">Opico</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>?c=products&a=stokezast">Zaragoza</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>?c=products&a=stokesast">Santa Ana</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>Hola, <?php echo $nombre." ".$apellido;?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="<?=PATH?>?c=products&a=show">Editar Cuenta</a></li>
                        <li><a class="dropdown-item" href="<?=PATH?>?c=user&a=close">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>

            </ul>

        </div>
    </div>
</nav>