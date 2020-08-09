<template>
<div>
    <!-- Navbar -->
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
               <a href="#" id="menu-link" size="sm">
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
               <a href="#" id="menu-link" size="sm" class="dropdown-toggle info" data-toggle="dropdown">
                   <b-icon-images></b-icon-images>
                        Galerias
                    
                </a>
                
                <ul style="list-style: none" class="dropdown-menu">
                    <li><a href="/galeriaNoticias" id="submenu-link" size="sm">Noticias</a></li>
                    <hr>
                    <li><a href="#" id="submenu-link" size="sm">Imagens</a></li>
                    <hr>
                    <li><a href="#" id="submenu-link" size="sm">Videos</a></li>
                    <hr>
                    <li>Item 2.4</li>
                </ul>
            </li>
           <hr>
           <li>Item</li>
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
    
    
<!-- Conteudo da página, fora da navbvar -->
    <div :v-if="imgs_galeria == true">
        <h1 align='center'>Imagens da Galeria{{imgs_galeria.nome_galeria}}</h1>
        <hr>
    </div>
    <!-- ButtonToolbar da página -->
    <div align='center'>
        <b-button-toolbar key-nav aria-label="Toolbar with buttons groups">
            <b-button-group class="mx-1">
                <b-button href="#" variant="danger" class="mr-1" @click="remove_galeria(imgs_galeria, $event.target)">
                    <b-icon-trash2-fill></b-icon-trash2-fill>
                        Remover Galeria
                </b-button>
            </b-button-group>
        </b-button-toolbar>

        <b-modal :id="remove_galeriaModal.id" :title="remove_galeriaModal.title" hide-footer>
            <b-form @submit="destroy_galeria" method="post">
                <input v-for="(n_img, key) in imgs_galeria" :key="key" type="hidden" :v-model="form.id" :value="n_img.id">
                    
                    <p>Você tem certeza que quer remover esta galeria ?<br>
                        clique em 'Remover'.<br>
                        Caso não esteja confiante, clique no 'x' na parte superior 
                        direita da janela para cancelar a ação. 
                    </p>

                    <div>
                        <b-button-group>
                            <b-button variant="danger" class="mr-1" type="submit">Confirmar</b-button>
                        </b-button-group>
                    </div>

            </b-form>
           
        </b-modal>
    </div>  
    <br>

    <div align='center'>
        <div 
            class="card"
            style="width: 18rem; display: inline-block" 
            v-for="(img, key) in imgs_galeria" 
            :key="key"
        >
            <img  :src="'../../../'+img.nome_imagem" :alt="img.nome_imagem" class="card-img-top">
                <div class="card-body">
                    <input type="hidden" :v-model="form.nome_galeria" :value="img.id">
                    <h6 class="card-title">{{img.nome_imagem}}</h6>
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
         <b-modal :id="removeModal.id" title="Remover Galeria" hide-footer>
            <div class="d-block text-center">
                <b-form @submit="destroy">  

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
       
        
    </div>
</div>

</template>

<script>
    export default{
        props: ['user','imgs_galeria'],
        data(){
            return{
                form:{
                    id: '',
                    nome_imagem: '',
                    nome_galeria: '',
        },

                //Modal de remoção de imagem
                removeModal: {
                    id: 'remove-modal',
                    title: '',
                    content: '',
                },
                //Modal de remoção da galeria
                remove_galeriaModal: {
                    id: 'remove-galeria-modal',
                    title: 'Remover Galeria',
                    content: '',
                },

                img: '',
                n_img: '',
                
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
               })
               .catch(function(error){
                   Vue.$toast.danger('Erro ao efetuar logout', {
                       message: 'contate a equipe de suporte técnico',
                       type: "info",
                       position: 'top-right'
                   });
               });

           },
        //Função que recebe os valores das variaveis
        //E cria janelo modal
            remove(img, button)
            {
                this.removeModal.title = `Row index: ${img.id}`
                this.removeModal.content = JSON.stringify(img, null, 2)
                this.$root.$emit('bv::show::modal', this.removeModal.id, button)
                return this.img = JSON.parse(this.removeModal.content)
            },
         //Modal para remover galeria
            remove_galeria(imgs_galeria, button)
            {
                
                this.remove_galeriaModal.content = JSON.stringify(imgs_galeria, button)
                this.$root.$emit('bv::show::modal', this.remove_galeriaModal.id, button)
                return this.imgs_galeria = JSON.parse(this.remove_galeriaModal.content) 
            },

        //Methodos que envia os valores para a api
        //Este metodo deve remover as linhas desejadas
            destroy(e,img)
            {
                e.preventDefault();
                let currentObj = this;
                let id = this.img.id;

                axios.get(`/teste/galeriaImg/destroy/${id}`,{id: this.form.id})
                    .then(function(response){
                        Vue.$toast.success('Imagem Removida', {
                        message: 'Imagem removida com sucesso com sucesso.',
                        type: "success",
                        position: 'top-right'
                        });
                        location.reload();
                       //console.log(response);
                    }).catch(function(error){
                        Vue.$toast.warning('Nao foi possível remover a imagem', {
                        message: `Erro ao remover imagem, contate o suporte técnico. Erro: ${error}`,
                        type: "warning",
                        position: 'top-right'
                    });
                        //console.log(error)
                    });
            },
            //Methodo que remove a galeria
            destroy_galeria(e, imgs_galeria){
                e.preventDefault();
                let currentObj = this;
                let id = this.img_galeria.id;
                console.log(id);
                axios.post(`/teste/galeriaImg/destroy_galeria/${id}`, {id: this.form.id})
                console.log('Merdea');
            },

        },
        mounted(){
            this.user = JSON.parse(this.user);
            this.imgs_galeria = JSON.parse(this.imgs_galeria);
            console.log('component mounted');
        }
    }
</script>