<template>
    <!-- Div Navbar --> 
  <div @onload="checkSupport()">
        <b-navbar toggleable="sm" type="dark" variant="info">
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
    <b-container fluid="sm">
        <b-row>
            
            <!-- Jumtron notícias em destaque -->
            <b-col cols="8">
                <div style="max-width: 60rem;" class="mt-3">
                   

                        <b-jumbotron bg-variant="white" text-variant="dark" border-variant="secondary">
                        
                            
                                <p class="h4">Destaque</p>

                        
                                <div img-blank v-for="(destaque, key) in n_destaque" :key="key">
                                    
                                    
                                    <p class="h1" style="color: #17a2b8">{{destaque.titulo}}</p>
                                    <span v-html="destaque.content"></span>
                                    
                       

                                </div>
                            

                    </b-jumbotron>

                    
               </div>
            </b-col>
            <b-col>
                
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="8">
                <!-- Div Das notícias completas -->
                <div class="mt-3" v-for="(n, key) in limitedNoticias" :key="key">
                    
                        <b-card
                            tag="article"
                            class="mb-4">
                            <div v-for="(u_img,key) in upload_img" :key="key">
                            
                                <template v-if="u_img.id_noticia == n.id">
                                    <img :src="u_img.nome_imagem" :alt="u_img.nome_imagem" style="max-width: 10rem; width: 25rem; float: left">
                                </template>
                            </div>
                        
                            <span><p class="h1" style="color: #17a2b8"><a v-bind:href="'/teste/show/' + n.id">{{n.titulo}}</a></p></span>
                            <br>
                            <template>
                            <span v-html="n.content.substr(0, 50)" ></span>
                            </template>
                            <br>
                            <div v-for="(c, key) in categorias" :key="key" style="float: right">
                                <template v-if="c.id === n.id_categoria">
                                <span>
                                        <p>
                                            
                                            <span style="color: gray">{{n.created_at | moment("from" , "now", true)}}</span> 
                                            Em - <a href="#">{{c.nome_categoria}}</a>
                                        </p>
                                    </span>
                                </template>
                            
                            </div>
                            
                        </b-card>
                        
                </div>

                <!-- Botão que carrega a função de leia mais -->
                <div align='center'>
                    <b-button block class="mr-1" size="lg" variant='outline-info' @click="limitNoticias += 5">
                        <b-icon-plus></b-icon-plus>
                            Veja Mais
                    </b-button>
                </div>
                <br>
            </b-col>

            <!-- Coluna das ultimas notícias cadastradas -->
            <b-col>
                <div class="mt-3 responsive">
                    <!--Inicia o card que receberá as ultimas notícias cadastradas -->
                    <b-card
                        tag="article"
                        style="max-width: 18rem; padding: 0%;"
                        class="mb-2">
                        <p class="h5">Últimas Notícias</p>
                        <hr class="my-4" style="background-color: #17a2b8; max-width: 18rem;">

                        <ul style="list-style: none; max-width: 10rem; padding: 0%;">
                            <li  v-for="(u_noticia, key) in u_noticias" :key="key" >
                                <p class="h5" style="color: #17a2b8"><b><a href="#">{{u_noticia.titulo}}</a></b></p>
                                
                                <span v-html="u_noticia.content.substr(0, 20)"></span>
                                <br>
                                <p><small>Em: {{u_noticia.created_at}}</small></p> 
                                <hr class="my-4" style="background-color: #17a2b8; max-width: 100%;">
                               
                            </li>
                        </ul>
                        <!--Botão Leia mais Recebe uma fynçao para ler mais notícias-->
                        <div align='center'>
                         <b-button class="mr-1" size="sm" variant="outline-info">Veja Mais</b-button>
                         </div>
                    </b-card>    
                    
                </div>

                <div class="d-flex">
                    <b-card
                        tag="article"
                        style="max-width: 18rem; padding: 0%;"
                        class="mb-2">
                        <p class="h5">Eventos</p>
                        <hr class="my-4" style="background-color: #17a2b8; max-width: 100%;">
                        
                        <ul style="list-style: none; margin-left: -2.5rem;">
                            <li v-for="(e, key) in eventos" :key="key">
                               <table class="table responsive" style="max-width: 2rem;  padding: 0%">
                                               
                                                <tbody>
                                                    <td>
                                                       <p class="h5"><a href="#">{{e.nome_evento}}</a></p>
                                                        <p><small><span v-html="e.descricao_evento.substr(0, 20)"></span></small></p>
                                                        <p style="font-size: 0.8rem"><small><b>Data</b> {{e.data_evento}} <b>Hora:</b> {{e.hora_evento}}</small></p>
                                                    </td>
                                                    <td>
                                                         <b-img 
                                                            :src="e.imagem_evento" 
                                                            :alt="e.imagem_evento"
                                                            class="responsive"
                                                            style="max-width: 4rem; width: 6rem; float: right; color: #17a2b8"
                                                            thumbnail
                                                            fluid
                                                        >
                                                        </b-img>
                                                        
                                                    </td>
                                                </tbody>
                                                
                                            </table>

                                
                            </li>
                            <hr class="my-4" style="background-color: #17a2b8; max-width: 100%;">
                        </ul>

                        <div align='center'>
                                    <b-button variant="outline-info" size="sm">Veja Mais</b-button>
                                </div>
                    </b-card>
                    
                </div>

                <div class='d-flex'>
                    <b-card
                        tag="article"
                        style="max-width: 18rem; padding: 0%;"
                        class="mb-2">
                        <p class="h5">Vídeos</p>
                        <hr class="my-4">

                        <p>Nesta div vou carregar os videos....</p>    
                    </b-card>
                </div>


                
            </b-col>
            <!-- Fim da coluna -->

        
            
        </b-row>
        <b-row>
            <b-col>
                <div>
                    <b-modal hide-footer title="Assine a nossa newsletter" v-model="modalShow" size='lg' centered>
                        <div class="d-block text-center">
                            <b-form inline @submit="assing" method="post">
                        
                          <label class="sr-only" for="inline-form-input-name">Seu Nome:</label>
                          <b-input
                            id="inline-form-input-name"
                            class="mb-2 mr-sm-2 mb-sm-0"
                            placeholder="Seu nome aqui..."
                            v-model="form.nome_user"
                            required>
                            
                            </b-input>
                            
                            <label class="sr-only" for="inline-form-input-email">Email</label>

                            <b-input-group prepend="@" class="mb-2 mr-sm-2 mb-sm-0">
                                <b-input 
                                    id="inline-form-input-email" 
                                    placeholder="Seu Email..." 
                                    v-model="form.email_user"
                                    required>
                                </b-input>
                            </b-input-group>
                            
                            <b-button class="mr-1" size="sm" variant="success" type="submit" @click="modalShow = false" style="margin-left: 10rem">
                                <b-icon-brush></b-icon-brush>
                                     Increver-se
                            </b-button>

                           
                            
                        </b-form>
                        </div>
                    </b-modal>
                </div>
            </b-col>
        </b-row>
        <!--
        <b-row>x
            <b-col>
                <div>   
                    
                    <div class="newsletter-window-form mt-3" >
                        <span>
                            <p class="h5" align="center">Inscreva-se na nossa newsletter 
                                 <span position="top-right"><b-button onclick="self.close()">
                                        <b-icon-x-circle></b-icon-x-circle>
                                        
                                    </b-button></span>   
                            </p> 
                            
                                <hr>
                               
                        </span>
                        <b-form inline @submit="assing">
                        
                          <label class="sr-only" for="inline-form-input-name">Seu Nome:</label>
                          <b-input
                            id="inline-form-input-name"
                            class="mb-2 mr-sm-2 mb-sm-0"
                            placeholder="Seu nome aqui...">
                            
                            </b-input>
                            
                            <label class="sr-only" for="inline-form-input-email">Email</label>

                            <b-input-group prepend="@" class="mb-2 mr-sm-2 mb-sm-0">
                                <b-input id="inline-form-input-email" placeholder="Seu Email..."></b-input>
                            </b-input-group>
                           
                            <b-button class="mr-1" size="sm" variant="dark" type="submit" style="margin-left: 10rem">
                                <b-icon-brush></b-icon-brush>
                                     Increver-se
                            </b-button>

                           
                            
                        </b-form>
                        
                    </div>

                </div>
                    
            </b-col>
        </b-row> -->
        <br>
       <b-row>
           <b-col></b-col>
                <!-- Aqui apenas estou exibindo as notificações de novas noticias para futuro pusher -->
            <b-col></b-col>
           <b-col>
               <template>
                   <view class="container">
                       <text class="text-color-primary">{{JSON.stringify(noticias)}}</text>
                   </view>
               </template>
               <div v-for="n in noticias" v-bind:key="n.id">
                    <div>
                        <b-card border-variant='info'>
                                <b-card-title>
                                    
                                    <div>
                                    <b-button-close 
                                        label="x" 
                                        variant="info" 
                                        text-variant="dark" @click="closeNotify">&times</b-button-close>

                                        <p class="h5" align="center"><b>Nova Notificação de Notícia</b></p>
                                    </div>
                                </b-card-title>
                                <hr style="color: #fff">
                                
                                <b-card-body>
                                    <b-card-text>
                                        <p class="h6">{{n.titulo}}</p>

                                        <p class="h7">{{n.content.substr(0, 50)}}</p>

                                        <p align="right"><small>
                                            {{n.created_at}} - {{n.fonte}}
                                            </small>
                                        </p>
                                    </b-card-text>
                                </b-card-body>
                            </b-card>
                        
                        
                    </div>
                   
                    
               </div>
           </b-col>
       </b-row>
       <br>
        
        <!-- Footer -->
        <b-row>
            <b-col cols="12">
                <div>
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
       
        props: ['n_destaque','f_noticias', 'u_noticias', 'categorias', 's_noticia',
                 'eventos', 'upload_img'],
        data(){
            return {
                //variaveis
                n_destaque: '',
                f_noticias: '',
                limitNoticias: 5,
                u_noticias: '',
                categorias: '',
                s_noticia: '',
                eventos: '',
                upload_img: '',
                modalShow: true,
                noticias: [],
               
               
               form: {
                    nome_user: '',
                    email_user: '',
                },
                
                
            }
        
        },
        created()
        {
            this.listenForChanges();
        },
        methods: {
            checkSupport(){
                if(window.Notification){
                    console.log('Notificações são suportadas');
                }
                else{
                    alert('Notificações não suportadas neste browser ! :(');
                }
            },
            listenForChanges()
            {
                Echo.channel('notify-received')
                .listen('SendNoticia', noticias => {
                    if(! ('Notification' in window)){
                        alert('Web notification is not supported');
                        return;
                    }
             
                    Notification.requestPermission( permission => {
                        let notification = new Notification(noticias.titulo, {
                            body: noticias.content.substr(3, 50)+'...',
                            icon: "https://w0.pngwave.com/png/327/1019/chi-s-sweet-home-cat-hello-kitty-manga-anime-cat-png-clip-art.png",
                            vibrate: [200, 100, 200], //opcional imagem da pagina do pusher
                           // requireInteraction: shouldRequireInteraction,
                        });

                               if(window.Notification){
                    console.log('Notificações são suportadas');
                }
                else{
                    alert('Notificações não suportadas neste browser ! :(');
                }


                        //Link para pagiina ao clicar na notificação
                        notification.onclick  = () => {
                            window.open(window.location.href);
                        };
                    });
                //this.noticias.push(e);
            });
            },
            assing(e)
            {
                e.preventDefault();
                axios.post(`/newsletterAssing/assing/create`, {nome_user: this.form.nome_user, email_user: this.form.email_user})
                .then(function(response){
                    Vue.$toast.success('Sua Assinatura foi feita com sucesso...',{
                        message: 'Agradecemos por se inscrever em nossa newsletter...',
                        type: 'success',
                        position: 'top-right',
                        
                    });

                    
                })
                .catch(function(error){
                    Vue.$toast.warning('Não foi possível realizar a sua inscrição',{
                        message: 'Não foi possível relizar sua inscrição, tente novamente mais tarde... Erro:' + error + 'Entre em contato com suporte técnico...',
                        type: 'warning',
                        position: 'top-right',
                      
                       
                    });
                });

                
            },
            closeNotify()
            {
                return alert('Fechar Janela de notificação...');
            }
        },

        computed: {
            limitedNoticias(){
                return this.f_noticias.slice(0, this.limitNoticias)
            },
            
        },
        mounted(){
            this.n_destaque = JSON.parse(this.n_destaque);
            this.f_noticias = JSON.parse(this.f_noticias);
            this.u_noticias = JSON.parse(this.u_noticias);
            this.categorias = JSON.parse(this.categorias);
            this.s_noticia = JSON.parse(this.s_noticia);
            this.eventos = JSON.parse(this.eventos);
            this.upload_img = JSON.parse(this.upload_img);
            /*Echo.channel('notify-received')
            .listen('SendNoticia', (e) => {
                this.noticias.push(e);
            });*/
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active{
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /*.fade-leave-active em versões anteriores a 2.1.8*/{
        opacity: 0;
    }
    /**
    * Syles da janela da newsletter
    * aqui vou carregar todos os elementos necessários 
    * para a criação da Janela de  inscrição da newsletter
    */
    .newsletter-window-form{
        background-color: #17a2b8;
        color: #fff;
        opacity: 0.6;
        max-width: 30rem;
        padding: 1rem;
        float: right;
        position: fixed;
        top: 20rem;
        right: 7.3rem;
        border: 1px solid #000;
        
    }
    
    /*#notify{
        transition: blink 3s;
    }
    #notify{
        background-color: #000;
    }*/
</style>