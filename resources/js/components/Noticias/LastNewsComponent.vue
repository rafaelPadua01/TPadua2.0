<template>
    
        <!-- Div Navbar --> 
    <div @onload="checkSupport()" style="margin-top: -2.1%">
        <b-navbar type="dark" variant="info">
            <b-navbar-brand href="#">Project Name</b-navbar-brand>
           
               <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
                

                <!--<b-collapse id="nav-collapse" is-nav>
                    <b-navbar-nav>
                        <b-nav-item href="/home">Home</b-nav-item> 
                        
                         navBar DropDowns 
                    <b-nav-item-dropdown text="User" right>
                     Usando 'button-content' slot 
                        <template v-slot:button-content>
                            <em>{{user.name}}</em>
                        </template>
                        <b-dropdown-item href="#">Account</b-dropdown-item>
                        <b-dropdown-item href="#">Settings</b-dropdown-item>
                    </b-nav-item-dropdown>
                    </b-navbar-nav> -->
                    
                    
                     <!-- item nav alinhados a direita -->
                    <b-navbar-nav class="ml-auto">
                        <b-nav-form>
                            <b-form-input size="sm" class="mr-sm-2" placeholder="Buscar"></b-form-input>
                            <b-button size="sm" class="my-2 my-sm-0" type="submit">Buscar...</b-button>
                        </b-nav-form>

                    <!-- Botão SideBar -->
                    <b-nav-item class="ml-auto" text="Menu" right>
                        <b-button size="sm" v-b-toggle.sidebar-backdrop-footer variant="info">
                         <b-icon-three-dots-vertical></b-icon-three-dots-vertical>
                            
                    </b-button>
                </b-nav-item>
            </b-navbar-nav>
        <!-- </b-collapse> -->
    </b-navbar>
    <!-- Carrega a sideBar 
    <div>
     <b-sidebar
      id="sidebar-backdrop-footer"
      title="Dashboard"
      bg-variant="info"
      text-variant="light"
      aria-label="Sidebar with custom footer"
      backdrop
      shadow
    >
    <hr>
    
   
    <div class="px-2 py-1">
          Menu com links e etc 
       <ul id="menu-links" style="list-style: none">
           <li>
                <a href="/admin" id="menu-link">
                    <b-icon-x-diamond-fill size="sm"></b-icon-x-diamond-fill>
                        DashBoard
                </a>
            </li>
           <hr>
           <li>
               <a href="/categorias" id="menu-link" size="sm">
                    <b-icon-archive size="sm"></b-icon-archive>
                        Categorias
                </a>
            </li>
           <hr>
           <li>
               <a href="/teste" id="menu-link" size="sm">
                 <b-icon-newspaper size="sm"></b-icon-newspaper>
                        Notícias
                </a>
            </li>
           <hr>
           <li>
               <a href="/galeriaNoticias" id="menu-link" size="sm">
                   <b-icon-images></b-icon-images>
                        Galerias
                    
                </a>
             </li>   
               
           <hr>
           <li>
               <a href="/arte_cultura" id="menu-link" size="sm">
                <b-icon-card-checklist></b-icon-card-checklist>
                    Arte e Cultura
                </a>
            </li>
       </ul>
       
      </div>
      <template v-slot:footer="{hide}">
        <div class="d-flex bg-dark text-light align-items-center px-3 py-2">
            <strong class="mr-auto">Footer</strong>
            <b-form>
                <b-button size="sm" @click="logout" variant="dark">
                    <b-icon-box-arrow-in-left></b-icon-box-arrow-in-left> 
                     Logout
                </b-button>
                <b-button size="sm" @click="hide" variant="dark">
                    <b-icon-x></b-icon-x> 
                    
                </b-button>
                
            </b-form>
            
        </div>
    </template>
    </b-sidebar>
    </div>-->
    <br>

    <!-- Area central -->
    <b-container fluid="lg">
    <b-row>
        <b-col></b-col>
        <b-col cols="8">
            <template>
                <div>
                    <b-card v-for="(last, index) in last_news" v-bind:key="index" class="text-center">
                    <b-card-text>
                        <template>
                            <h1 style="color: #17a2b8">{{last.titulo}}</h1>
                            <!-- loop que percorre a variavel categorias e armazena em cat -->
                            <span v-html="last.content.substr(0, 100) + '...'"></span>
                            <!-- compara se a id de cat é identica a id contida na ultima notícia
                                para exibir o nome que a categoria possui -->
                            <p v-for="(cat,index) in categorias" v-bind:key="index">
                                <small style="color: gray" v-if="cat.id === last.id_categoria">{{last.created_at | moment("from", "now") }} 
                                Em - <a href="#">{{cat.nome_categoria}}</a></small>
                            </p>
                            
                        </template>
                         <hr>
                        <template>
                            <span v-html="last.content"></span>
                        </template>
                        
                        <hr>
                        <template>
                            <p>
                                Redes sociais, compartilhamentos, Janela modal de comentários aqui...
                            </p>
                        </template>
                        
                    </b-card-text>
                    </b-card>
                    <br>
                
                </div>

               
                    
                
            </template>
        </b-col>
        
        <b-col></b-col>
       
    </b-row>

    </b-container>
    <br>


    <b-container>
     <!-- Footer -->
        <b-row>
            <b-col cols="12">
                <div style="margin-bottom: -2.3%">
                    <b-card bg-variant="info" border-variant="light">

                        <b-card-text>
                            <p style="color: #fff" align='center'>Project name - &copy; 2020 </p>
                        </b-card-text>
                    </b-card>
                 </div>
            </b-col>
        </b-row>


     </b-container> 

    </div>


    
</template>

<script>
    export default{
        props: ['last_news', 'categorias'],
        data(){
            return {
                
                
            }
        },
        mounted(){
            this.last_news = JSON.parse(this.last_news);
            this.categorias = JSON.parse(this.categorias);
        }
    }
</script>