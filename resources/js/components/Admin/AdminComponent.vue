<template>
<!-- Div Navbar --> 
  <div>
        <b-navbar toggleable="sm" type="dark" variant="info">
            <b-navbar-brand href="#">Project Name</b-navbar-brand>
           
                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
                

                <b-collapse id="nav-collapse" is-nav>
                    <b-navbar-nav>
                        <b-nav-item href="/home">Home</b-nav-item>
                        
                        <!-- navBar DropDowns -->
                    <b-nav-item-dropdown text="User" right>
                    <!-- Usando 'button-content' slot -->
                        <template v-slot:button-content>
                            <em>{{user.name}}</em>
                        </template>
                        <b-dropdown-item href="#">Account</b-dropdown-item>
                        <b-dropdown-item href="#">Settings</b-dropdown-item>
                    </b-nav-item-dropdown>
                    </b-navbar-nav>
                    
                    <!-- Navbar dropDown notificações -->
                    <b-navbar-nav>
                        <b-nav-item-dropdown centered>
                        <template v-slot:button-content>
                            <em><b-icon-heart-fill></b-icon-heart-fill></em>
                        </template>
                        <b-dropdown-item v-for="(notification, index) in notifications" :key="index" @click="updateNotifications">
                            <div align='center' class="mt-3 justify-content-center" v-if="notification.data.comentario">
                                <p>
                                    <small>
                                        <b>Usuario:</b>
                                        {{notification.data.comentario.nome_user_coment}}
                                        <b>Email:</b>
                                        {{notification.data.comentario.email_user_coment}}
                                        
                                        <br>
                                     </small>
                                </p>
                                <small v-html="notification.data.comentario.content_coment.substr(3, 50)">
                               
                                </small>
                                <small>
                                    <b>Enviado em:</b>
                                        {{notification.created_at}}
                                        <b>Lida em:</b>
                                        {{notification.read_at}}
                                </small>
                            </div>
                            <hr>
                            <div align='center' class="mt-3 justify-content-center" v-if="notification.data.resposta">
                                <p>
                                    <small>
                                        <b>Usuario:</b>
                                        {{notification.data.resposta.nome_user_coment_reply}}
                                        <b>Email:</b>
                                        {{notification.data.resposta.email_user_coment_reply}}
                                        
                                        <br>
                                     </small>
                                </p>
                                <small v-html="notification.data.resposta.content_coment_reply.substr(3, 50)">
                               
                                </small>
                                <small>
                                    <b>Enviado em:</b>
                                        {{notification.created_at}}
                                        <b>Lida em:</b>
                                        {{notification.read_at}}
                                </small>
                            </div>
                            
                     
                        </b-dropdown-item>
                        <div align="center">
                            <b-button class="mr-1" size="sm" variant="link" @click="destroyNotifications" align="center">
                                <b-icon-trash></b-icon-trash>
                                Limpar
                            </b-button>
                        </div>

                    
                    </b-nav-item-dropdown>
                    </b-navbar-nav>
                    
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
         </b-collapse>
    </b-navbar>
    <!-- Carrega a sideBar -->
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
         <!-- Menu com links e etc -->
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
    </div>
    <br>
<!-- Area central -->
    <div>
        <b-container class="bv-example-row bv-example-row-flex-cols">
            <b-row align-v="start">
                <!-- Primeira coluna Vazia, default -->
                <b-col></b-col>
                <!-- Coluna central onde serão
                    carregados os Cards -->
                <b-col cols="12" sm="8" md="8">
                    <!-- Div que encapsula os cards em grupos -->
                    <div class="mt-3">
                        <!-- Primeiro Grupo -->
                        <b-card-group deck>
                            <b-card
                                
                               id="b-card-relogio"
                                border-variant="dark"
                                bg-variant="dark" 
                                overlay
                                img-src="/img/admin/depositphotos_243837686-stock-video-pocket-watch-background-sky.jpg"
                                img-alt="Card Image"
                                header-bg-variant="dark"
                                header-text-variant="white"
                                align="center"
                                class="text-center"
                                style="max-width: 18rem;">
                                
                                <b-card-text>
                                   <p><small><b>Hora: {{ hoje.getHours() }} : {{hoje.getMinutes()}} : {{hoje.getSeconds()}}</b></small></p>
                                    
                                  <p><small><b>Data: {{hoje.getDate()}} / {{hoje.getMonth() }} / {{hoje.getFullYear()}}</b></small></p>
                                </b-card-text>
                            </b-card>
                        <!-- Card dos Comentários -->
                        
                        <a href="/comments" @click="updateNotifications">
                            <b-card
                                deck
                                id="comentarios_a"
                                border-variant="primary"
                                bg-variant="light" 
                                text-variant="light"
                                align="center"
                                class="text-center"
                                overlay 
                                img-src="/img/admin/comment.png"
                                img-alt="Card Image"
                                style="max-width: 18rem;">

                                <b-card-text>
                                     <div v-if='notifications.length >= 1'>
                                        <span class="h1 mb-2">
                                            <b-icon-exclamation-circle-fill 
                                                variant="danger"
                                                aling='right' 
                                                style="max-width: 5rem; float: right; margin-top: -1rem; margin-right: -1rem"
                                                id="tooltip-count-notify"
                                                >
                                               
                                                </b-icon-exclamation-circle-fill>
                                             <b-tooltip target="tooltip-count-notify" variant='danger'>{{notifications.length}}</b-tooltip>
                                        </span>
                                       
                                    </div>
                                    <p>Clique aqui para ver os comentários</p>
                                    <hr>
                                    <div>
                                    
                                        <p>
                                            <small>
                                                <b>Comentarios:</b> ({{comentarios.length}})
                                                <b>Respostas:</b> ({{respostas.length}})
                                                 <b>Notificações:</b> ({{notifications.length}})
                                            </small>
                                        </p>
                                    
                                    </div>
                                </b-card-text>

                                
                            </b-card>
                        </a>
                        <!-- Card das notícias recebidas -->
                        <a href="#">
                            <b-card
                                deck
                                border-variant="success"
                                bg-variant="light" 
                                text-variant="dark"
                                align="center"
                                class="text-center"
                                overlay
                                img-src="/img/admin/news.png"
                                style="max-width: 18rem;"
                                >
                                <b-card-text style="color: #fff">Notícias Recebidas</b-card-text>
                            </b-card>
                        </a>
                        </b-card-group>
                    </div>

                    <!-- Segundo Grupo Newsletter -->
                    <div class="mt-3">
                        
                            <b-card-group deck>
                                <a href="/newsletter" >
                                    <b-card
                                        id="newsletter_a"
                                        border-variant="info"
                                        bg-variant="light" 
                                        align="center"
                                        class="text-center"
                                        overlay
                                        img-src="/img/admin/users.png"
                                        img-alt="users"
                                        style = 'max-width: 14rem;'>
                                        <b-card-text style="color: #fff">
                                            <p>Clique aqui para ir para a <b>Newsletter</b></p>
                                        </b-card-text>
                                    </b-card>
                                </a>

                            <b-card
                                border-variant="info"
                                bg-variant="light" 
                                header="Relogio"
                                header-bg-variant="info"
                                header-text-variant="white"
                                align="center"
                                class="text-center">
                                <b-card-text>Relogio Aqui</b-card-text>
                            </b-card>

                        </b-card-group>
                    </div>
                </b-col>
                <b-col></b-col>
            </b-row>

            <!--<b-row align-v="end">
                <b-col style="border: 1px solid #000">1 of 3</b-col>
                <b-col cols="5" style="border: 1px solid #000">2 of 3 (wider)</b-col>
                <b-col style="border: 1px solid #000">3 of 3</b-col>
            </b-row> -->
           
        </b-container>
    </div>
</div>

</template>

<script>
    export default {
        props: ['user', 'comentarios', 'respostas'],
        data(){
            return{
            //Variavel que recebe data/hora atual
            hoje: new Date(),
            str_data: '',
            notifications: [],
           
            }
        },
        methods: {
            logout(e)
            {
                e.preventDefault();
                axios.post('/logout')
                .then(function (response)
                {
                    Vue.$toast.info('Logout realizado com sucesso.',{
                         message: 'Logout realizado com sucesso',
                           type: 'info',
                           position: 'top-right',
                    });
                    //console.log('logout');
                   // location.reload();
                })
                .catch(function(error)
                {
                    Vue.$toast.warning('Logout realizado com sucesso.',{
                        message: 'erro ${error}, contante o administrador do sistema',
                        type: 'warning',
                        position: 'top-right',
                    });
                });
            },
            indexNotifications()
            {
                axios.get('/notifications/index')
                .then(response => this.notifications = response.data.notifications)
            },
            loadNotifications()
            {
                axios.get('/notifications')
                .then(response => this.notifications = response.data.notifications)
            },
            updateNotifications(){
                axios.get('/notifications/update')
                .then(response => this.notifications = response.data.notifications)
            },
            destroyNotifications(){
                axios.get('/notifications/destroy')
                .then(response => this.notifications = response.data.notifications)
            },
            
           
            
        },
        computed: {
            notifications(){
                return this.notifications
            }
            
        },
        mounted()
        {
            this.user = JSON.parse(this.user);
            this.comentarios = JSON.parse(this.comentarios);
            this.respostas = JSON.parse(this.respostas);
            this.loadNotifications();
            this.indexNotifications();
        }
}
</script>

<style>
    #menu-link{
        width: 100px;
        height: 100%;
        color: #fff;
        transition: width 2s;
    }

    #menu-link:hover{
        color: #000;
        width: 300px;
        height: 100%;
        padding: 5%;
        font-size: 1.0rem;
    }

    #submenu-link{
        width: 100%;
        height: 100%;
        
    }
    #submenu-link:hover{
        
        width: 300px;
        height: 100%;
        padding: 5%;
        font-size: 1.0rem;
    }
    #b-card-relogio{
        font-size: 1rem;
        color: #fff;
        transition: background-color 2s;
    }

    #b-card-relogio:hover{
        font-size: 1rem;
        filter: brightness(130%);
        filter: drop-shadow(1% 1% 1% #fff); 
    }
    #newsletter_a{
        max-width: 18rem;
        font-size: 1rem;
        transition: background-color 2s;
    }
    #newsletter_a:hover{
        filter: brightness(110%); 
        filter: drop-shadow(1% 1% 1% #fff);
    }
    #comentarios_a{
        max-width: 18rem;
        font-size: 1rem;
        transition: background-color 2s;
    }
    #comentarios_a:hover{
        filter: brightness(110%);
        filter: drop-shadow(1% 1% 1% #fff);
    }
</style>