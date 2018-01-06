    <nav>
          <div class="nav-wrapper">
            
            <a href="#!" class="brand-logo">GIS Astra</a>
            <a href="#" data-activates="slide-out" class="button-collapse mynav pulse"><i class="material-icons">menu</i></a>
             
             <ul id="slide-out" class="side-nav fixed">
              <li><div class="user-view">
                <div class="background">
                  <img src="http://materializecss.com/images/office.jpg">
                </div>
                <a href="#!user"><img class="circle" src="http://materializecss.com/images/yuna.jpg"></a>
                <a href="#!name"><span class="white-text name">{{Auth::user()->username}}</span></a>
                <a href="#!email"><span class="white-text email">{{Auth::user()->email}}</span></a>
              </div></li>
              
              <!-- admin menu -->

              @if(Auth::user()->id_role==1)
              <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                    <li>
                      <a class="collapsible-header" href="/akun_pengguna">Akun Pengguna</a>
                      <div class="collapsible-body">
                       
                      </div>
                    </li>
                   </ul>
              </li>
              @endif

              <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                    <li>
                      <a class="collapsible-header">Master Data</a>
                      <div class="collapsible-body">
                        <ul>
                          <li><a href="/informasi_arho">Informasi Arho</a></li>
                          <li><a href="#!">Informasi Wilayah</a></li>
                          <li><a href="#!">Informasi Kredit</a></li>
                        </ul>

                      </div>
                    </li>
                   </ul>
              </li>


               <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                    <li>
                      <a class="collapsible-header" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign Out</a>
                      <div class="collapsible-body">
                       
                      </div>
                    </li>
                   </ul>

                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                    </form>
              </li>
           

           </ul>



          </div>
      </nav>

