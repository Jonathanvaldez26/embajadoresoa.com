<aside id="sidebar-left" class="sidebar-left">
				
				    <div class="sidebar-header">
				        <div class="sidebar-title">
				            Menu
				        </div>
				        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>
				
				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">
				            
				                <ul class="nav nav-main">
				                    <li class="nav">
				                        <a class="nav-active" href="./">
				                            <i class="fas fa-user-md" aria-hidden="true"></i>
				                            <span>Registro</span>
				                        </a>                        
				                    </li>
									
									<li class="nav"> 
				                    	<a href="gafetes_mostrar.php">
				                    		<i class="fas fa-address-card" aria-hidden="true"></i>
				                    		<span>Gafetes total</span>
				                    	</a>
				                    </li>

				                    <li class="nav"> 
				                    	<a href="taller.php">
				                    		<i class="fas fa-address-card" aria-hidden="true"></i>
				                    		<span>Taller</span>
				                    	</a>
				                    </li>

				                   <!--  <li class="nav"> 
				                    	<a href="visualizaciones.php">
				                    		<i class="fas fa-eye" aria-hidden="true"></i>
				                    		<span>Visualización videos</span>
				                    	</a>
				                    </li>

				                    <li class="nav">
				                        <a class="nav-link" href="accesos.php">
				                            <i class="fas fa-users" aria-hidden="true"></i>
				                            <span>Accesos</span>
				                        </a>                        
				                    </li> -->

				                    
									
									<!-- <li class="nav-active">
				                        <a class="nav-link" href="agregar-curso.php">
				                            <i class="fas fa-plus" aria-hidden="true"></i>
				                            <span>Agregar curso</span>
				                        </a>                        
				                    </li>
									
									<li class="nav-active">
				                        <a class="nav-link" href="registrados.php">
				                            <i class="fas fa-users" aria-hidden="true"></i>
				                            <span>Usuarios registrados</span>
				                        </a>                        
				                    </li> -->
									
				                  
				                </ul>
				            </nav>
				
				            <hr class="separator" />
				
				            
				
				            <hr class="separator" />
				
				            
				        </div>
				
				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
				                    
				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>
				        
				
				    </div>
				
				</aside>