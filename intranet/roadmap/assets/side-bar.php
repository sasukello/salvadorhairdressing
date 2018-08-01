<div class="sidebar" data-color="azure" data-background-color="black" >
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
          Intranet-Salvador
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active">
                        <a class="nav-link" href="./index.php">
                        <i class="material-icons">dashboard</i>
                        <p>Inicio</p></a>
          </li>
          <li class="nav-item" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
             <a class="nav-link" href="#">
               <i class="material-icons">dashboard</i>
               <p>Proyectos</p>
             </a>
          </li>
                          <div class="collapse" id="collapseExample"">             <!--  colapse Proyectos -->
                           <li class="nav-item"  style="margin-left: 20px;">
                                        <a class="nav-link" href="./proyectos.php">
                                        <i class="material-icons">search</i>
                                        <p">Ver Proyectos</p></a>
                          </li>
                          <li class="nav-item"  style="margin-left: 20px;" >
                                        <a class="nav-link" href="#newproject" data-toggle="modal">
                                        <i class="material-icons">add_circle_outline</i>
                                        <p">Agregar Proyecto</p></a>
                          </li>
                            </div> 


          <li class="nav-item" data-toggle="collapse" data-target="#collapseCategorias" aria-expanded="false" aria-controls="collapseCategorias">
                        <a class="nav-link" href="#">
                        <i class="material-icons">list</i>
                        <p>Categorias</p></a>
          </li>
                           <div class="collapse" id="collapseCategorias"">             <!--  colapse Categorias -->
                           <li class="nav-item"  style="margin-left: 20px;">
                                        <a class="nav-link" href="./categorias.php">
                                        <i class="material-icons">search</i>
                                        <p">Proyectos por Categoria</p></a>
                          </li>
                          <li class="nav-item"  style="margin-left: 20px; cursor: pointer;" data-toggle="modal"
data-target="#minimodal" data-tipo= "nuevaCategoria">
                                        <a class="nav-link">
                                        <i class="material-icons">add_circle_outline</i>
                                        <p">Agregar Categoría</p></a>
                          </li>
                            </div> 
        </ul>
      </div>
      
    </div>