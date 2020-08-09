<template>
    <div>
        <!-- Navbar do componente -->
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
        <!-- Fim da navbar -->
    </div>

    <!-- Conteudo da Página do component -->
    <div class="mt-3" align="center">
        
        <h1 align='center'>Assínar Newsletter</h1>
        <hr>

        <div class="mt-3" >
           <p> Assíne a nossa Newsletter e fique por dentro das nossas atualizações...</p>
           
            <div class="d-flex justify-content-center">
                <b-form @submit="assing" method="post">
                    <b-form-group
                        id="input-group-name"
                        label="Digite seu nome:"
                        label-for="nome_user"
                    >
                        <b-form-input
                            id="nome_user"
                            v-model="form.nome_user"
                            description="Insira seu nome neste campo"
                            placeholder="Seu nome aqui..."
                            type="text"
                            required>
                        </b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-email"
                        label="Digite seu email:"
                        label-for="email_user"
                        >
                        
                            <b-form-input
                                id="email_user"
                                v-model="form.email_user"
                                type="email"
                                description="Insira seu e-mail neste campo"
                                placeholder="Seu Email aqui..."
                                required
                            ></b-form-input>
                        </b-form-group>
                    <b-button-group>
                         <b-button  href="#" variant="outline-info">
                            <b-icon-skip-backward></b-icon-skip-backward>
                                Voltar
                        </b-button>

                        <b-button type="submit" variant="outline-success">
                            <b-icon-check-all></b-icon-check-all>
                                Assínar
                        </b-button>
                       
                    </b-button-group>
                </b-form>
            </div>
        </div>
        <!-- Conteudo do Form de assinatura-->
        <div>
            
        </div>

    </div>
    <!-- Fim do conteudo da pagina -->
</div>
   
    
</template>

<script>
   export default {
       data(){
           return{
               form:{
                   nome_user: '',
                   email_user: '',
               }
           }
       },

       methods: {
           assing(e)
           {
               e.preventDefault();
               const currentObj = this;
               axios.post('/newsletterAssing/assing/create',{nome_user: this.form.nome_user, email_user: this.form.email_user})
               .then(function(response){
                   Vue.$toast.success('Assinatura realizada com sucesso...',{
                       message: 'Sua Assínatura foi realizada com sucesso, nos da equipe o agradecemos por se juntar....',
                       type: 'success',
                       position: 'top-right',
                   });
                   location.reload();
               })
               .catch(function(error){
                   Vue.$toat.danger('Assínatura não pode ser realizada...', {
                       message: 'Erro:' + this.error + 'contate o suporte técnico...',
                       type: 'warning',
                       position: 'top-right',
                   });
               });
           }
       },
       
       mounted(){
           console.log('Componente montado...');
       }
   }
</script>