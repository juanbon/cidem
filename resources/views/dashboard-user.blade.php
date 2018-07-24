
@extends('layout-user')
   
    @section("das")
    <section class="hero login is-light">
      <div class="hero-body">
        <div class="container has-text-centered">
          <h1 class="title ">
            Panel de administración
          </h1>
          <br>
        </div>

        <div class="container">
          
          <div class="columns is-multiline">
            <div class="column is-one-third">
              <div class="card">
              <div class="card-content has-text-centered">
                <p class="title">
                  <a href="#">
                    <span class="icon has-text-primary">
                    <i class="fas fa-2x fa-cog"></i>
                  </span>
                </a>
                </p>
                
              </div>
              <footer class="card-footer">
                <p class="card-footer-item">
                  <a href="#" class="has-text-primary">
                    Administración
                  </a>
                </p>
                
              </footer>
            </div>
              
            </div>
            <div class="column is-one-third">
              <div class="card">
              <div class="card-content has-text-centered">
                <p class="title">
                  <a href="#">
                    <span class="icon has-text-primary">
                    <i class="fas fa-2x fa-user"></i>
                  </span>
                </a>
                </p>
                
              </div>
              <footer class="card-footer">
                <p class="card-footer-item">
                  <a href="#" class="has-text-primary">
                    Control del Usuario
                  </a>
                </p>
                
              </footer>
            </div>
              
            </div>
            <div class="column is-one-third">
              <div class="card">
              <div class="card-content has-text-centered">
                <p class="title">
                  <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/lines/create') }}">
                    <span class="icon has-text-primary">
                    <i class="fas fa-2x fa-plus"></i>
                  </span>
                </a>
                </p>
                
              </div>
              <footer class="card-footer">
                <p class="card-footer-item">
                  <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/lines/create') }}" class="has-text-primary">
                    Nueva fuente
                  </a>
                </p>
                
              </footer>
            </div>
              
            </div>
            <div class="column is-one-third">
              <div class="card">
              <div class="card-content has-text-centered">
                <p class="title">
                  <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/lines') }}">
                    <span class="icon has-text-primary">
                    <i class="fas fa-2x fa-edit"></i>
                  </span>
                </a>
                </p>
                
              </div>
              <footer class="card-footer">
                <p class="card-footer-item">
                  <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/lines') }}" class="has-text-primary">
                    Editar fuentes
                  </a>
                </p>
                
              </footer>
            </div>
              
            </div>
            <div class="column is-one-third">
              <div class="card">
              <div class="card-content has-text-centered">
                <p class="title">
                  <a href="#">
                    <span class="icon has-text-primary">
                    <i class="fas fa-2x fa-list"></i>
                  </span>
                </a>
                </p>
                
              </div>
              <footer class="card-footer">
                <p class="card-footer-item">
                  <a href="#" class="has-text-primary">
                    Parámetros
                  </a>
                </p>
                
              </footer>
            </div>
              
            </div>
            <div class="column is-one-third">
              <div class="card">
              <div class="card-content has-text-centered">
                <p class="title">
                  <a href="#">
                    <span class="icon has-text-primary">
                    <i class="fas fa-2x fa-users"></i>
                  </span>
                </a>
                </p>
                
              </div>
              <footer class="card-footer">
                <p class="card-footer-item">
                  <a href="#" class="has-text-primary">
                    Vista - Usuario
                  </a>
                </p>
                
              </footer>
            </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
    

  
    <?php // include('footer.php');  */ ?>  


@endsection