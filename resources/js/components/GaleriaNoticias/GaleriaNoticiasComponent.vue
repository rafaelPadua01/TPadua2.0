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

<!-- Area central -->
    <div>
         <h1 align='center'>Galeria de imagens</h1>
    </div>
    <hr>
    <div align='center'>
        <ul class="nav nav-tabs" id="tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="imagens-tab" data-toggle="tab" href="#imagens"
                    role="tab" aria-controls="imagens" aria-selected="true">
                    Imagens
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="galeriaImagens-tab" data-toggle="tab" href="#galeriaImagens"
                    role="tab" aria-controls="galeriaImagens" aria-selected="false">
                        Galeria de Imagens
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos"
                    role="tab" aria-controls="videos" aria-selected="false">
                        Videos
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" id="galeriaVideos-tab" data-toggle="tab" href="#galeriaVideos"
                    role="tab" aria-controls="galeriaVideos" aria-selected="false">
                        Galeria de Videos
                </a>
            </li>
        </ul>
        <!-- Div da Imagens das notícias -->
        <div class="tab-content" id="tab-content">
            <div class="tab-pane fade show active" id="imagens" role="tabpanel" aria-labelledby="imagens-tab">
              <br>
              <!-- Input do buscador de Imagens -->
              <div class="mt-3">
                <b-form-input type='text' placeholder="Buscador de Imagem..." class="sm mb-2" size="sm" v-model="s_img.filter"></b-form-input>
                    <p>
                        Você buscou por: {{s_img.filter}}
                    </p>
                
              </div>
              <!-- Inicia a div do card -->
                <div 
                    class="card"
                    style="width: 18rem; display: inline-block" 
                    v-for="(img, key) in filteredImg" 
                    :key="key"
                    >
                    <img :src="img.nome_imagem" :alt="img.nome_imagem" class="card-img-top">
                    <div class="card-body">
                         <input type="hidden" :v-model="form.id" :value="img.id">
                        <h6 class="card-title">{{img.nome_imagem.slice(24, 100)}}</h6>
                        <p class="card-text">Data de upload: {{img.created_at}}</p>

                        <div class="btn-group" align='center'>
                           <!-- <a href="#" class="btn btn-primary"><b-icon-eye-fill></b-icon-eye-fill>Visualizar</a>-->
                            <b-button @click="remove(img, img.id, $event.target)" class="mr-1" variant="outline-danger">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                        Remover
                            </b-button>

                            
                        </div>
                    </div>
                </div>

                <b-modal :id="removeModal.id" :title="removeModal.title" hide-footer>
                            <div class="d-block text-center">
                                <b-form @submit="destroyImg">  

                                    <h6>Nome Imagem: <br>{{img.nome_imagem}}</h6>

                                   
                                    <p>Você tem certeza que quer remover esta imagem ?<br>
                                        clique em 'Remover'.<br>
                                        Caso não esteja confiante, clique no 'x' na parte superior 
                                        direita da janela para cancelar a ação. 
                                    </p>

                                    <div class="btn-group" align='center'>
                                    
                                    <b-button 
                                        class="mt-3" 
                                        size="md" 
                                        variant="outline-danger" 
                                        block
                                        type="submit"
                                        @click="$bvModal.hide(removeModal)"
                                    >
                                            <b-icon-trash2-fill></b-icon-trash2-fill>
                                                Remover
                                    </b-button>
                                </div>

                                </b-form>
                                </div>
                            </b-modal>
                <div align='center'>
                    <b-pagination class="mt-3" v-model="currentPage" pills :total-rows="img.length" align='center'></b-pagination>
                </div>        
            </div>

            <!-- Aba Galeria de Imagens -->
            <div class="tab-pane fade" id="galeriaImagens" role="tabpanel" aria-labelledby="galeriaImagens-tab">
                <br>
                <div class="form-group">
                    <b-form-input type='text' class="sm mb-2" size="sm" placeholder="Buscar galeria..." v-model="configs.filter"></b-form-input>  
                     <p>Você buscou por: {{configs.filter}}</p>
                </div>
                <br>
                <div class="wrapper">
                <div 
                    class="card" 
                    style="display: inline-block"
                    v-for="(galeria, key) in filtered"
                    :key="key"
                    
                >
                <br>

                    
                    <div class="card-body">
                        <div style="" align="center">
                            <p class="h1 mb-2">
                                <b-icon-folder variant="info"></b-icon-folder>
                            </p>
                            <!-- Slice remove todo o caminho do diretorio, deixando apenas o nome -->
                            <h6>{{ galeria.slice(24, 100) }}</h6>
                           
                        </div>
                        <hr>
                        <div class="btn-group" align='center'>
                            <b-button href="#" @click="preview(galeria)" class="sm-3" variant="outline-info">
                                <b-icon-eye-fill></b-icon-eye-fill>
                                    visualizar
                            </b-button>
                            <!--<a href="#" @click="update(galeria, index, $event.target)" class="mr-1" variant="info">
                                <b-icon-cursor-text></b-icon-cursor-text>
                                    renomear
                            </a>-->
                            <b-button class="sm-3" variant="outline-danger" @click="remove_galeria(galeria, $event.target)">
                                <b-icon-trash-fill></b-icon-trash-fill>
                                    Remover
                            </b-button>
                        </div>
                    </div>    
                </div>
                 <!-- Modal delete(remover galeria) -->
                <div>
                    <b-modal :id="remove_galeriaModal.id" :title="remove_galeriaModal.title" hide-footer>
                        <div class="d-block text-center">
                        <b-form @submit="destroy_galeria" method="post">
                            <input type="hidden" :v-model='form.nome_galeria' :value="galeria">

                            
                            <p>Você tem certeza que quer remover esta galeria ?<br>
                                clique em 'Remover'.<br>
                                Caso não esteja confiante, clique no 'x' na parte superior 
                                direita da janela para cancelar a ação. 
                            </p>

                        <div>
                            <b-button-group>
                                <b-button type="submit" variant="danger" class="mr-1"  block @click="$bvModal.hide(remove_galeriaModal)">Confirmar</b-button>
                            </b-button-group>
                        </div>
                        </b-form>
                        </div>
                    </b-modal>
                </div>
                <!--Paginação -->
            </div>
            <div class="mt-3">
                    <b-pagination v-model="currentPage" pills :total-rows="galerias.length " :per-page="perPage" align='center'></b-pagination>
                </div>
            </div>
            
            <!-- Div Dos videos das notícias -->
            <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                <br>
                <div class="mt-3">
                <b-form-input type='text' placeholder="Buscador de Imagem..." class="sm mb-2" size="sm" v-model="s_videos.filter"></b-form-input>
                    <p>
                        Você buscou por: {{s_videos.filter}}
                    </p>
                
                </div>
                <br>
                    <div class="card" style="width: 18rem; display: inline-block" v-for="videos in  filteredVideos" :key="videos.id">
                       
                       
                            
                        <div class="card-body">
                        <div>
                            <b-embed type="video" aspect="4by3" controls>
                                <source :src="videos.nome_video" type="video/mp4">
                            </b-embed>
                        </div> 
                         <div>
                            <div v-for="noticia in noticias" :key="noticia.id">
                                <template v-if="noticia.id === videos.id_noticia">
                                    <p>{{noticia.titulo}}</p>
                                </template>
                            </div>
                            </div>
                            
                            <div class="btn-group" align='center'>
                                <b-button class="sm-3" variant="outline-danger" @click="remove_video(videos, videos.id, $event.target)">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                        Remover
                                </b-button>
                            </div>       
                        </div>
                    </div>

                 <!-- Modal delete(remover video) -->
                <div>
                    <b-modal :id="remove_videoModal.id" :title="remove_videoModal.title" hide-footer>
                        <div class="d-block text-center">
                        <b-form @submit="destroy_video" method="post">
                            <input type="hidden" :v-model='form.nome_video' :value="videos.nome_video">
                            <input type="hidden" :v-model='form.id' :value="videos.id">
                            
                            <p>Você tem certeza que quer remover este video ?<br>
                                clique em <b style="color: red">'Remover'</b>.<br>
                                Caso não esteja confiante, clique no <b>'x'</b> na parte superior 
                                direita da janela para cancelar a ação. 
                            </p>

                        <div>
                            <b-button-group>
                                <b-button type="submit" variant="outline-danger" class="mr-1"  block @click="$bvModal.hide(remove_videoModal)">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                        Remover
                                </b-button>
                            </b-button-group>
                        </div>
                        </b-form>
                        </div>
                    </b-modal>
                </div>

                <div align='center'>
                    <b-pagination class="mt-3" v-model="currentPage" pills :total-rows="videos.length" align='center'></b-pagination>
                </div>
                        
            </div>
           

            <!-- Div da galeria de videos -->
            <div class="tab-pane fade" id="galeriaVideos" role="tabpanel" aria-labellledby="galeriaVideos-tab">
                <div class="form-group">
                    <b-form-input type='text' class="sm mb-2" size="sm" placeholder="Buscar galeria Videos..." v-model="s_g_videos.filter"></b-form-input>  
                     <p>Você buscou por: {{s_g_videos.filter}}</p>
                </div>
                <br>

                <div class="card" style="display: inline-block" v-for="video in filteredVideosGaleria" :key="video.id">
                    <div classs="card-body">
                        <div align="center">
                        <p class="h1 mb-2">
                            <b-icon-folder-fill variant="info"></b-icon-folder-fill>
                        </p>

                        <p>{{video.nome_galeria}}</p>
                        </div>
                        <hr>

                        <div align='center'>
                          <b-button-group>
                                <b-button  class="sm-3" variant="outline-primary" @click="preview_galeria_video(video)">
                                    <b-icon-eye-fill></b-icon-eye-fill>
                                    Visualizar
                                </b-button> 

                                <b-button class="sm-3" variant="danger" @click="remove_galeria_videos(video, video.id, $event.target)">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                    Remover
                                </b-button>

                            </b-button-group>
                        </div>
                    </div>
                   
                </div>
                 <!-- Modal da galeria de videos -->
                  <b-modal :id="remove_galeriaVideoModal.id" :title="remove_galeriaVideoModal.title" hide-footer>
                            <div class="d-block text-center">
                                <b-form @submit="destroy_galeria_video" method="post">  

                                    <h6>Nome galeria: <b>{{video.nome_galeria}}</b></h6>

                                   
                                    <p>Você tem certeza que quer remover esta galeria ?<br>
                                        clique em <b style="color: red">'Remover'</b>.<br>
                                        Caso não esteja confiante, clique no 'x' na parte superior 
                                        direita da janela para cancelar a ação. 
                                    </p>

                                    <div class="btn-group" align='center'>
                                    
                                    <b-button 
                                        class="mt-3" 
                                        size="md" 
                                        variant="outline-danger" 
                                        block
                                        type="submit"
                                        @click="$bvModal.hide(remove_galeriaVideoModal)"
                                    >
                                            <b-icon-trash2-fill></b-icon-trash2-fill>
                                                Remover
                                    </b-button>
                                </div>

                                </b-form>
                                </div>
                            </b-modal>
                 
                <div align='center'>
                    <b-pagination class="mt-3" v-model="currentPage" pills :total-rows="videos.length" align='center'></b-pagination>
                </div>
            </div>
        </div>
    </div> 
    <br>
    <!-- Modal formulário renomear 
    <div>
        <b-modal :id="updateModal.id" :title="updateModal.title" hide-footer>
           <b-form @submit="rename" method="put">
               <input type="text" :v-model="form.id" :placeholder="galeria">
               <b-form-group
                id="input-group-1"
                label="Nome Galeria:"
                label-for="input-1"
                description="Digite o Novo nome para a galeria"
                >
                <b-form-input
                    id="input-1"
                    v-model="form.nome_galeria"
                    type="text"
                    required
                    placeholder="Entre com o novo nome para a galeria"
                    >
                </b-form-input>
                </b-form-group>

                <b-button type="reset" variant="warning">Limpar</b-button>
                 <b-button type="submit" variant="success">Alterar</b-button>
            </b-form>
        </b-modal>
    </div>-->
    
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
    export default {
        props: ['images', 'user', 'galerias', 'noticias', 'dir_galerias',  'imgs_galeria', 'videos', 'dir_videos', 'galeria_videos'],
       data(){
           return{
               //Variveis
                galeria: [],
                img: '',
                videos: '',
                video: [],
                galeria_videos: '',
                currentPage: 1,
                rows: 1,
                perPage: 5,
               form:{
                   id: '',
                   id_user: '',
                   id_noticia: '',
                   nome_imagem: '',
                   nome_galeria: '',
                   nome_video: '',
                   
                },

                //Variaveis dos filtros
                s_img: {
                    orderBy: 'stargazers_count',
                    order: 'desc',
                    filter: '',
                },
                configs: {
                    orderBy: 'stargazers_count',
                    order: 'desc',
                    filter: '',
                },
              
                s_videos: {
                    orderBy: 'stargazers_count',
                    order: 'desc',
                    filter: '',
                },
                s_g_videos: {
                    orderBy: 'stargazers_count',
                    order: 'desc',
                    filter: '',
                },
                //Cria a modalde update da galeria
                updateModal: {
                    id: 'update-modal',
                    title: '',
                    content: "",
                },
                //Cria a modalpreview
                previewModal: {
                    id: 'preview-modal',
                    title: '',
                    content: "",
                },
                removeModal: {
                    id: 'remove-modal',
                    title: '',
                    content: '',
                },
                remove_galeriaModal: {
                    id: 'remove_galeria-modal',
                    title: '',
                    content: '',
                },
                remove_videoModal: {
                    id: 'remove_video-modal',
                    title: '',
                    content: '',
                },
                remove_galeriaVideoModal: {
                    id: 'remove_galeria_video-modal',
                    title: '',
                    content: '',
                },

           }
       },
       
       computed:{
           //Metodo que filtra as Imagens e retorna para o loop
           filteredImg()
           {
               const filter_img = this.s_img.filter;
               const f_img = _.orderBy(this.images, this.s_img.orderBy, this.s_img.order);
               if(_.isEmpty(filter_img))
               {
                   return f_img;
               }
               return _.filter(f_img, img => this.img.indexOf(filter_img) >= 0);
           },
           //Cria o metodo de filtragem dos diretorios
           filtered()
           {
               const filter = this.configs.filter;
               const diretorio = _.orderBy(this.dir_galerias, this.configs.orderBy, this.configs.order);

               if(_.isEmpty(filter))
               {
                   return diretorio;
               }

               return _.filter(diretorio, galeria => this.galeria.indexOf(filter) >= 0);
           },
           //Filtra os videos 
           filteredVideos()
           {
               const filter_video = this.s_videos.filter;
               const f_videos = _.orderBy(this.videos, this.s_videos.orderBy, this.s_videos.order);
               if(_.isEmpty(filter_video))
               {
                    return f_videos;
               }
               
               return _.filter(f_videos, videos => this.videos.indexOf(filter_video) >= 0);
           },
           //Filtra os Videos da galeria de videos
           filteredVideosGaleria()
           {
               const filter_video_galeria = this.s_g_videos.filter;
               const f_g_videos = _.orderBy(this.galeria_videos, this.s_g_videos.orderBy, this.s_g_videos.order);
               if(_.isEmpty(filter_video_galeria))
               {
                   return f_g_videos;
               }
               return _.filter(f_g_videos, video => this.video.indexOf(filter_video_galeria) >= 0);
           }
       },
       
       methods: {
           logout(e)
           {
               e.preventDefault();
               axios.post('/logout')
               .then(function(response){
                   Vue.$toast.info('Logout Realizado com sucesso', {
                       message: 'logout realizado com sucesso.',
                       type: "info",
                       position: 'top-right'
                    });
                    location.reload();
               })
               .catch(function(error){
                   Vue.$toast.danger('Erro ao efetuar logout', {
                       message: 'contate a equipe de suporte técnico',
                       type: "info",
                       position: 'top-right'
                   });
               });

           },
           //Methods da Janela Modal remover Imagem
           removeImgModal()
           {
               this.$refs['remove-img-modal'].show()
           },
           hideModal()
           {
               this.$refs['remove-img-modal'].hide()
           },
            remove(img,  button){
                this.removeModal.title = `Row Index: ${img.id}`
                this.removeModal.content = JSON.stringify(img, null, 2)
                this.$root.$emit('bv::show::modal', this.removeModal.id, button)
                return this.img = JSON.parse(this.removeModal.content)
            },
            remove_galeria(galeria, button)
            {
                this.remove_galeriaModal.title = `Row Index: ${galeria}`
                this.remove_galeriaModal.content = JSON.stringify(galeria, null, 2)
                this.$root.$emit('bv::show::modal', this.remove_galeriaModal.id, button)
                return this.galeria = JSON.parse(this.remove_galeriaModal.content) 
            },
            remove_video(videos, button)
            {
                this.remove_videoModal.title = `Row Index: ${videos.id}`
                this.remove_videoModal.content = JSON.stringify(videos, null, 2)
                this.$root.$emit('bv::show::modal', this.remove_videoModal.id, button)
                return this.videos = JSON.parse(this.remove_videoModal.content)
            },
            remove_galeria_videos(video, button)
            {
                this.remove_galeriaVideoModal.title = `Row Index: ${video.id}`
                this.remove_galeriaVideoModal.content = JSON.stringify(video, null, 2)
                this.$root.$emit('bv::show::modal', this.remove_galeriaVideoModal.id, button)
               return this.video = JSON.parse(this.remove_galeriaVideoModal.content)
                
            },
           //Methodo que remove a imagem
           destroyImg(e, img)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.img.id;
               
               axios.get(`/teste/uploadImg/destroy/${id}`, {id: this.form.id})
               .then(function(response){
                   Vue.$toast.success('Imagem removida com sucesso', {
                       message: 'Imagem removida...',
                       type: "success",
                       position: 'top-right'
                    });
                    location.reload();
                   //console.log(response);
               })
               .catch(function(error){
                   Vue.$toast.warning('Erro ao remover Imagem', {
                       message: 'Entre em contato com o suporte técnico...',
                       type: "warning",
                       position: 'top-right'
                    });
                   //console.log(error);
               });
           },
           //methodos que remove galeria
           destroy_galeria(e, galeria)
           {
               e.preventDefault();
               let currentObj = this;
               var nome_galeria = this.galeria.slice(24, 100);
              
               
               axios.post(`teste/galeriaImg/destroy_galeria/` + nome_galeria, {nome_galeria: this.nome_galeria})
               .then(function(response){
                   Vue.$toast.success('Galeria Removida com sucesso',{
                       message: 'A galeria foi removida com sucesso...',
                       type: 'success',
                       position: 'top-right'
                   });
                   location.reload();

                   //window.alert(nome_galeria);
               })
               .catch(function(error){
                    Vue.$toast.warning('Galeria não pode ser reemovida',{
                       message: 'A galeria não foi removida, contate o suporte técnico...',
                       type: 'warning',
                       position: 'top-right'
                   });
                  

                   //window.alert(nome_galeria);
               });
           },
           //Metodo que remove videos
           destroy_video(e, videos)
           {
                e.preventDefault();
                let currentObj = this;
                let nome_video = this.videos.nome_video.slice(23, 100);
                var id = this.videos.id;

                axios.post(`/teste/video_destroy/${id}`, {
                    nome_video: this.form.nome_video, id: this.id
                })
                .then(function(response){
                    Vue.$toast.success('Video Removido com sucesso...', {
                        message: 'O video foi removido com sucesso',
                        type: 'success',
                        position: 'top-right',
                    });
                    location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Erro ao remover video da base de dados',{
                        message: 'Erro : ' + error + 'contate o suporte técnico...',
                        type: 'warning',
                        position: 'top-right',
                    });
                });

           },
           //Methodo que remove a galeria de videos
           destroy_galeria_video(e, video)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.video.id;

               axios.post(`/teste/galeria_video_destroy/${id}`, {
                   nome_galeria: this.form.nome_galeria, id: this.id
               })
               .then(function(response){
                   Vue.$toast.success('A galeria foi removida com sucesso...',{
                       message: 'A galeria foi removida com sucesso',
                       type: 'success',
                       position: 'top-right',
                   })
               })
               .catch(function(error){
                   Vue.$toast.warning('A galeria não pode ser removida...', {
                       message: 'Erro: ' + error + 'Contate o suporte técnico',
                       type: 'warning',
                       position: 'top-right'
                   });
               });
           },
           //methodos da Janela Modal preview
           preview(galeria)
           {
               var img_galeria = galeria.slice(24, 100);
               //console.log(img_galeria);
               //console.log(galeria);
               //redireciona usuario para a tela com as imagens da galeria
               window.location.assign("/teste/galeriaImg/preview/"+img_galeria);
               //return this.img_galeria = JSON.parse(galeria);
               /*
               axios.get(`/teste/galeriaImg/preview/${img_galeria}`)
               .then(function(response){
                   console.log(response);
               })
               .catch(function(error){
                   console.log(error);
               });
               */

           },
           preview_galeria_video(video)
           {
               var video_galeria = video.nome_galeria;
               window.location.assign("/teste/galeria_video/preview/"+video_galeria);
           },
           //Methods da Janela modal de update
           update(galeria, index, button)
           {
               this.updateModal.title = `Row index: ${index}`
               this.updateModal.content = JSON.stringify(galeria, null, 2)
               this.$root.$emit('bv::show::modal', this.updateModal.id, button)
               return this.galeria = JSON.parse(this.updateModal.content)
           },
           rename(e)
           {
               e.preventDefault();
               var currentObj = this;
               let id = this.id;
               axios.post(`/galeriaImg/${id}`, {
                   id: this.form.id, nome_galeria: this.form.nome_galeria
               })
               .then(function(response){
                   console.log(response);
               })
               .catch(function(error){
                   console.log(error);
               });
           }
       },
        mounted(){
           this.images = JSON.parse(this.images);
           this.user = JSON.parse(this.user);
           this.galerias = JSON.parse(this.galerias);
           this.dir_galerias = JSON.parse(this.dir_galerias);
           this.noticias = JSON.parse(this.noticias);
           this.imgs_galeria = JSON.parse(this.imgs_galeria);
           this.videos = JSON.parse(this.videos);
           this.dir_videos = JSON.parse(this.dir_videos);
           this.galeria_videos = JSON.parse(this.galeria_videos);
          
        }
    }
</script>