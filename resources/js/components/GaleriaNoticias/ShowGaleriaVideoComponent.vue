<template>
     <!-- Div Navbar --> 
  <div style="margin-top: -2.3%">
        <b-navbar toggleable="lg" type="dark" variant="info">
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

    <!-- Área central -->
    <div align='center'>
        <div v-if="videos_galeria.length <= 0">
            <div>
                <template>
                    <p>Está galeria está vazia</p>
                </template>
            </div>
        </div>
        <div align='center'>
            <h1>{{videos_galeria.nome_galeria}}</h1>
        </div>
        <hr>
        <div 
            class='card'
            style="width: 18rem; display: inline-block"
        >
            
            <div class="card-body">
                
                <div>
                    <template>
                        <b-embed type="video" aspect="4by3" controls>
                            <source v-for="(video, key) in videos_galeria" :key="key" :src="'../../../'+videos_galeria.nome_video"  type="video/mp4">
                        </b-embed>
                    </template>
                </div>
                <div class="card-footer">
                    <template>
                        <b-button-group>
                            <b-button class="mt-3" variant="outline-danger" @click="remove_video(videos_galeria.nome_video, $event.target)">
                                <b-icon-trash-fill></b-icon-trash-fill>
                                    Remover
                            </b-button>
                        </b-button-group>
                       
                    </template>
                </div>
            </div>
        </div>
        
        <!-- div da Janela modal de remoção dos videos-->
        
                <b-modal :id="removevideoModal.id" :title="removevideoModal.title" hide-footer>
                    <div class="d-block text-center">
                        <b-form @submit="destroy_video" method="post">
                            <p class="h3">Nome da galeria: {{video.nome_galeria}}</p>
                            <input type="hidden" :v-model="form.id" name="id" :value="video.id">
                            <input type="hidden" :v-model="form.nome_video" name="nome_video" :value="video.nome_video">
                            <input type="hidden" :v-model="form.nome_galeria" name="nome_galeria" :value="video.nome_galeria">
                            <p>Você tem certeza que quer remover este video ?<br>
                                clique em <b style="color: red">'Remover'</b>.<br>
                                Caso não esteja confiante, clique no <b>'x'</b> na parte superior 
                                direita da janela para cancelar a ação. 
                            </p>
                            <hr>
                            
                        <div class="btn-group" align='center'>
                        <b-button 
                            class="mt-3" 
                            size="md" 
                            variant="outline-danger" 
                            block
                            type="submit"
                           
                        >
                            <b-icon-trash2-fill></b-icon-trash2-fill>
                                Remover
                        </b-button>
                    </div>

                        </b-form>
                       

                      
                    </div>
                </b-modal>
        
         
    </div>

    <!-- Div do footer -->
     <br>
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

</div>
</template>

<script>
    export default
    {
        props: ['videos_galeria', 'user'],
        data(){
            return {
                video: '',
                //formulario 
                form:{
                    id: '',
                    nome_video: '',
                    nome_galeria: '',
                },
                removevideoModal:{
                    id: 'remove-video-modal',
                    title: '',
                    content: '',
                },
            }

        },
        methods:{
            logout(e){
                e.preventDefault();
                axios.post('/logout')
                .then(function(response){
                    Vue.$toast.success('Logout relaizado com sucesso', {
                        message: 'Você foi deslogado com sucesso, volte sempre...',
                        type: 'success',
                        position: 'top-right',
                    });
                })
                .catch(function(error){
                    Vue.$toast.danger('Erro ao relizar logout...', {
                        message: 'Erro: ' + error + 'Contate o suporte técnico, não foi possível relizar logout...',
                        type: 'danger',
                        position: 'top-right',
                    })
                });
            },
            remove_video(videos_galeria, button)
            {
                this.removevideoModal.title = `Row index: ${videos_galeria.id}`
                this.removevideoModal.content = JSON.stringify(this.videos_galeria, null, 2)
                this.$root.$emit('bv::show::modal', this.removevideoModal.id, button)
                return this.video = JSON.parse(this.removevideoModal.content)
            },
            destroy_video(e, video)
            {
                e.preventDefault();
                let currentObj  = this;
                var id = this.video.id;

                axios.post(`/teste/video_galeria_destroy/${id}`, {id: this.form.id, nome_video: this.form.nome_video, nome_galeria: this.form.nome_galeria})
                .then(function(response){
                    Vue.$toast.success('O video foi removido com sucesso ...', {
                        message: 'O vídeo foi removido com sucesso da galeria...',
                        type: 'success',
                        positon: 'top-right',
                    });

                    location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Erro ao remover o vídeo...', {
                        message: 'Erro: ' + error + 'ao remover o vídeo da galeria',
                        type: 'warning',
                        position: 'top-right',
                    });
                });
            }
        },
       
       
        mouted(){
            this.videos_galeria = JSON.parse(this.videos_galeria);
            this.user = JSON.parse(this.user);
          
        }
    }
</script>