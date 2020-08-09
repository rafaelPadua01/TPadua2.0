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
        <!-- Fim da navbar -->
    </div>

    <!-- Conteudo da Página do component -->
    <div class="mt-3">
        
        <h1 align='center'>Newsletter</h1>
        <hr>

        <!-- Conteudo do card e das navs-->
        <div>
           
            <b-card no-body>
                <!-- Inicia o tab dos Usuarios da Newsleter-->
                    <b-tabs card>
                        <!-- Nav dos usuários -->
                        <div>
                            <b-tab title="Usuários da newsletter" active>
                                <div>
                                    <b-input-group size="sm">
                                        <b-form-input 
                                            v-model="filter"
                                            type=search
                                            id="filterInput"
                                            placeholder="Type to search"
                                            :filter="filter"
                                          
                                        ></b-form-input>
                                        <b-input-group-append>
                                            <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                                        </b-input-group-append>
                                    </b-input-group>
                                    <br>
                                    <b-table
                                        stripped
                                        hover
                                        bordered
                                        responsive="sm"
                                        caption-top
                                        :items="items"
                                        :fields="fields"
                                        :filter="filter"
                                        primary-key="id"
                                        :per-page="perPage"
                                        :current-page="currentPage"
                                    >
                                    <template v-slot:cell(acoes)="row">
                                        <b-button-group>
                                            <b-button size="sm" class="mr-1" variant="outline-info" 
                                                @click="update(row.item, row.index, $event.target)">
                                                <b-icon-reply></b-icon-reply>
                                                    Atualizar
                                            </b-button>
                                            <b-button size="sm" class="mr-1" variant="outline-danger" 
                                                @click="remove(row.item, row.index, $event.target)">
                                                <b-icon-trash-fill></b-icon-trash-fill>
                                                    Remover
                                            </b-button>
                                            

                                        </b-button-group>
                                    </template>

                                    
                               
               
                                    </b-table>
                                   
                                </div>
                                <!-- Paginação da tabela -->
                                <div class="mt-3">
                                    <b-pagination 
                                        v-model="currentPage" 
                                        pills 
                                        :total-rows="items.length" 
                                        :per-page="perPage"
                                        align='center' 
                                        ></b-pagination>
                                </div>
                                <!-- Fim da páginação -->

                            </b-tab>
                            
                            <!-- Tab form de envio da newsletter -->
                            <b-tab title="Enviar Newsletter">
                                <div>
                                    <div class="d-flex content-left">
                                        
                                        <!-- Aqui será carregada a lista de usuários assinantes -->    
                                        <b-container class="bv-example-row">
                                            <b-row>
                                                
                                                <!-- exibe os usuarios cadastrados -->
                                                <b-col>
                                                    <div class="mt-3" style="max-width: 15rem;"  v-b-scrollspy:nav-scroller>
                                                        <h6>Assinantes:</h6>
                                                        <hr>
                                                        
                                                        <b-form-group>
                                                            <template v-slot:label>
                                                                {{allSelected ? 'Desmarcar Todos:' : 'Selecionar todos:'}}
                                                                <b-form-checkbox
                                                                    v-model="allSelected" 
                                                                    :indeterminate="indeterminate"
                                                                    aria-describedby="users"
                                                                    aria-controls="users"
                                                                    @change="toggleAll"
                                                                >
                                                                </b-form-checkbox>
                                                                
                                                            
                                                            </template>
                                                            
                                                            <!-- Exibe a lista de usuários -->
                                                            <ul style="list-style:none; position: relative; height: 100px; overflow-y: scroll;" id="nav-scroller">
                                                                
                                                                <li v-for="(u_assing, key) in items" :key="key">
                                                                    
                                                                        <b-form-checkbox-group
                                                                            id="checkbox_users"
                                                                            v-model="selected"
                                                                            name="checkbox_users"
                                                                            class="ml-4"
                                                                            aria-label="Assinantes"
                                                                            stacked
                                                                        
                                                                            
                                                                        >
                                                                            <b-form-checkbox v-model="form.email_users" :value="u_assing.email_user" checked>{{u_assing.id}}.{{u_assing.nome_user}}</b-form-checkbox>
                                                                    
                                                                        </b-form-checkbox-group>
                                                                </li>
                                                            </ul>
                                                       </b-form-group>
                                                        <div>
                                                            <p>Marcados: <strong><small>{{selected}}</small></strong></p>
                                                            <p>Todos marcados: <strong>{{allSelected}}</strong></p>
                                                        </div>
                                                                    
                                                    </div>

                                                </b-col>
                                           
                                                <!-- Aqui vou criar o formulário de envio da newsletter -->
                                                <b-col>
                                                    <div class="mt-3" style="max-width: 18rem">
                                                        
                                                        <b-form @submit="sendMail">
                                                            <b-form-group
                                                                id="input-assunto-email"
                                                                label="Assunto do email:"
                                                                label-for="assunto_email"
                                                                description="Digite o assunto do email"
                                                            >
                                                            <b-form-input
                                                                id="assunto_email"
                                                                v-model="form.assunto_email"
                                                                placeholder="Newsletter tpadua ..."
                                                                class="mr-1">

                                                            </b-form-input>

                                                            </b-form-group>
                                                            <b-form-group
                                                               id="input-imagens-group"
                                                               label="Selecione as imagens desejadas"
                                                               label-for="imagens_newsletter"
                                                               description="selecione as imagens que deseja utilizar"
                                                            >
                                                            <!-- link para janela modal -->
                                                           <b-button v-b-modal.modal-img>Escolher imagens</b-button>
                                                         
                                                           <!-- Cria uma modal para carregar as imagens -->
                                                           <b-modal id='modal-img' title="Imagens disponíveis">
                                                               <div>
                                                                   <b-card
                                                                    v-for="(img,key) in img_noticia"
                                                                    :key="key"
                                                                    :img-src="img.nome_imagem"
                                                                    :img-alt='img.nome_imagem'
                                                                    tag="imagem-noticia"
                                                                    style="max-width: 10rem"
                                                                    class="mb-2">
                                                                       <b-form-checkbox v-model="form.files_img" :value="img.id" align='right'></b-form-checkbox>
                                                                   </b-card>

                                                                   {{form.files_img}}
                                                               </div>
                                                                
                                                           </b-modal>
                                                           <!-- Fim da modal -->

                                                            </b-form-group>
                                                             <div>
                                                              <p><b>Imagens:</b> <small>{{form.files_img}}</small></p>
                                                            </div>
                                                            <hr>
                                                            <div align='center'>
                                                                 clique no botão 'enviar newsletter' para confirmar o envio...
                                                                <b-button-group>
                                                                   <b-button class="mr-1" variant="outline-success" type="submit">
                                                                        <b-icon-check-all></b-icon-check-all>
                                                                            Enviar Newsletter
                                                                    </b-button>
                                                                </b-button-group>
                                                            </div>
                                                        </b-form>

                                                    </div>
                                                </b-col>
                                                <!-- Aqui vou carregar alguma coisa que eu ainda não sei -->
                                                <b-col>3 of 3</b-col>

                                            </b-row>
                                        </b-container>
                                        
                                    </div>
                                    
                                    
                                </div>
                            </b-tab>
                        </div>
                        <!-- Tab do Formulário de Cadastro de novos assinantes -->
                        <b-tab title="Cadastrar novo assinante">
                            <div class="mt-3">
                                <div class="d-flex justify-content-center">
                                    <!-- FOmulário de Cadastro de novos assinantes -->
                                    <b-form @submit="assing" method="post">
                                        <b-form-group
                                            id="input-group-name"
                                            label="Digite o nome:"
                                            label-for="nome_user"
                                        >
                                            <b-form-input
                                                id="nome_user"
                                                v-model="form.nome_user"
                                                description="Insira o nome neste campo"
                                                placeholder="nome aqui..."
                                                type="text"
                                                required>
                                            </b-form-input>
                                        </b-form-group>

                                        <b-form-group
                                            id="input-group-email"
                                            label="Digite o email:"
                                            label-for="email_user"
                                            >
                                            
                                                <b-form-input
                                                    id="email_user"
                                                    v-model="form.email_user"
                                                    type="email"
                                                    description="Insira o e-mail neste campo"
                                                    placeholder="Email aqui..."
                                                    required
                                                ></b-form-input>
                                            </b-form-group>

                                            <b-button-group align='center'>
                                                <!--<b-button  href="#" variant="outline-info">
                                                    <b-icon-skip-backward></b-icon-skip-backward>
                                                        Voltar
                                                </b-button>-->

                                                <b-button type="submit" variant="outline-success" class="mr-1">
                                                    <b-icon-check-all></b-icon-check-all>
                                                        Assínar
                                                </b-button>
                                            
                                            </b-button-group>
                                    </b-form>
                                </div>
                            </div>
                        </b-tab>
                        
                        <!-- Historio de newsletters enviadas -->
                        <b-tab title="Newsletter enviadas">
                            <!--Aqui Vou carregar a tabela com os dados da tabela de historico da newsletter -->

                            <div>
                                <!-- input de busca -->
                                <b-input-group size="sm">
                                    <b-form-input
                                        v-model="filter_history"
                                        type="search"
                                        id="filter_history"
                                        placeholder="Busca ...."
                                        :filter="filter">

                                    </b-form-input>
                                    
                                </b-input-group>

                                <br>
                                <!-- tabela que carrega os dados do historico-->
                                <b-table
                                    striped
                                    hover
                                    bordered
                                    responsive="sm"
                                    caption-top
                                    :items="n_history"
                                    :filter="filter_history"
                                    :fields="fields_history"
                                    :per-page="perPage"
                                    :current-page="currentPage"
                                    :sort-by-sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    small
                                    primary-key="id"
                                    >
                                     <template v-slot:cell(acoes_history)="row">
                                        <b-button-group>
                                            
                                            <b-button size="sm" class="mr-1" variant="outline-danger" 
                                                @click="removeHistory(row.item, row.index, $event.taget)">
                                                <b-icon-trash-fill></b-icon-trash-fill>
                                                    Remover
                                            </b-button>
                                            

                                        </b-button-group>
                                    </template>

                                    <template v-slot:table.caption>
                                        <div>
                                            <small>
                                                <b>Sorty by: </b> {{sortBy}}, <b>Sort Direction:</b> 
                                                    {{sortDesc ? 'Descending' : 'Ascending' }}
                                            </small>
                                        </div>
                                    </template>
                                    <template>

                                    </template>
                                </b-table>

                                <!-- Paginação da tabela -->
                                <div class="mt-3">
                                    <b-pagination 
                                        v-model="currentPage" 
                                        pills 
                                        :total-rows="n_history.length" 
                                        :per-page="perPage"
                                        align='center' 
                                        ></b-pagination>
                                </div>
                                <!-- Fim da páginação -->
                            </div>

                        </b-tab>
                    </b-tabs >

                    

                <!-- Fim da tab-->
            </b-card>

            
        </div>

        

    </div>
    <!-- Fim do conteudo da pagina -->

        <!-- Modal de atualização dos dados do assinante -->
        <div>
            <b-modal :id="updateModal.id" :title="updateModal.title" hide-footer>
                <b-form @submit="update_user" method="put">
                   
                    <b-form-group
                        id="input-group-nome"
                        label="Nome do Usuário"
                        label-for="nome_user">
                            <b-form-input
                                id="nome_user"
                                type='text'
                                v-model="form.nome_user"
                                :placeholder="item.nome_user"
                                required
                                description="Novo nome de usuário neste campo"
                                ></b-form-input>
                    </b-form-group>

                    <b-form-group
                        id="input-group-email"
                        label="Email do usuário"
                        label-for="email_user">
                            <b-form-input
                                id="email_user"
                                type="email"
                                v-model="form.email_user"
                                :placeholder="item.email_user"
                                required
                                description="Novo Email do usuario neste campo"></b-form-input>
                        </b-form-group>
                        <hr>
                        <div align='center'>
                            <b-button-group align='center'>
                                <b-button size="sm" class="mr-1" type="submit" variant='outline-success'>
                                    <b-icon-check-all></b-icon-check-all>
                                        Salvar
                                </b-button>
                            </b-button-group>
                        </div>
                </b-form>
                
            </b-modal>
        </div>

        <!-- Modal de remmoção de assinatura -->
        <div class="mt-3" align='center'>
            <b-modal :id="removeModal.id" :title="removeModal.title" hide-footer>
                <b-form @submit="destroy_assing" method="post">
                    <input type="hidden" :v-model="form.id" :value="item.id">
                    <div class="mt-3" align='center'>
                    <p>
                        Você deseja <b>remover</b> essa inscrição ?
                    </p>
                        
                    <p> clique no botão:</p>
                        <b-button variant="outline-danger" class="mr-1">
                            <b-icon-trash2-fill></b-icon-trash2-fill>
                                remover
                            </b-button>
                            <hr>
                            <div align='center'> 
                                <b-button-group>
                                    <b-button variant='outline-danger' class="mr-1" type="submit">
                                        <b-icon-trash2-fill></b-icon-trash2-fill>
                                            remover
                                    </b-button>
                                </b-button-group>
                            </div>
                    
                    </div>
                    
                </b-form>
            </b-modal>
        </div>

        <!-- Modal de remmoção de Historico -->
        <div class="mt-3" align='center'>
            <b-modal :id="removeHistoryModal.id" :title="removeHistoryModal.title" hide-footer>
                <b-form @submit="destroy_history" method="post">
                    <input type="hidden" :v-model="form.id" :value="item.id">
                    <div class="mt-3" align='center'>
                    <p>
                        Você deseja <b>remover</b> esse historico ?
                    </p>
                        
                    <p> clique no botão:</p>
                        <!--<b-button variant="outline-danger" class="mr-1">
                            <b-icon-trash2-fill></b-icon-trash2-fill>
                                remover
                            </b-button>-->
                            <hr>
                            <div align='center'> 
                                <b-button-group>
                                    <b-button size="sm" variant='outline-danger' class="mr-1" type="submit">
                                        <b-icon-trash2-fill></b-icon-trash2-fill>
                                            remover
                                    </b-button>
                                </b-button-group>
                            </div>
                    
                    </div>
                    
                </b-form>
            </b-modal>
        </div>
</div>
   
    
</template>

<script>
   export default {
        props: ['n_users_assing', 'user', 'img_noticia', 'history'],
       data(){
           return{
               
               user: '',
                items: [],
                n_history: [],
                item: '',
                u_assing: '',
                img_noticia: [],
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                selected: [],
                allSelected: false,
                indeterminate: false,
                
                //Define qual campo da tabela será usado para ordenação
                sortBy: "'assunto'",
                sortDirection: 1,
                sortDesc: true,
                
                //Cria os campos da tabela
                fields: [
                    {
                        key: 'id',
                        sortable: true,
                    },
                    {
                    key: 'nome_user',
                    sortable: true,
                    },
                    {
                        key: 'email_user',
                        sortable: true,
                    },
                    {
                        label: "Ações",
                        key: 'acoes',
                        sortable: false,
                        stickcolumn: true,
                        coltype: 'button',

                    }
                    
                ],
                fields_history: [
                    {
                        key: 'id',
                        sortable: true,

                    },
                    {
                        key: 'id_user',
                        sortable: true,
                    },
                    {
                        key: 'assunto',
                        sortable: true,
                    },
                    {
                        key: 'destinatarios',
                        sortable: true,
                    },
                    {
                        key: 'created_at',
                        sortable: true,
                    },
                    {
                        label: "Ações",
                        key: 'acoes_history',
                        sortable: false,
                        stickColum: true,
                        colType: 'button',
                    }
                ],
                //filtro do atributos
                filter: null,
                filter_history: null,
                
                //Janelas Modais
                updateModal:{
                    id: 'update-modal',
                    title: '',
                    content: "",
                },
                removeModal: {
                    id: 'remove-modal',
                    title: '',
                    content: '',
                },
                removeHistoryModal: {
                    id: 'removeHistory-modal',
                    title: '',
                    content: "",
                },

                //Formulário
                form: {
                    id: '',
                    nome_user: '',
                    email_user:'',
                    assunto_email: '',
                    files_img: [],
                    email_users: '',
                }
           }
           
       },
       computed: {
           sortOptions() {
               //cria uma lista de opcoes dos nossos campos
               return this.fields
               .fields(f=>f.sortable)
               .map(f=>{
                   return {text: f.label, value: f.key}
               })
           }
       },
       sortOptionsHistory(){
           //Cria uma lista de opcoes dos nosso campos
           return this.fields_history
           .fields(f=>f.sortable)
           .map(f=>{
               return {text: f.label, value: f.key}
           })
       },
       methods: {
           logout(e){
               e.preventDefault();
                axios.post('/logout')
                .then(function(response) {
                    Vue.$toast.success('Logout Realizado com sucesso...',{
                        message: 'Você foi deslogado com sucesso...',
                        type: "success",
                        position: 'top-right'
                    });
                    location.reload()
                })
                .catch(function(error){
                    Vue.$toast.warning('Erro ao efetuar logout', {
                        message: `Erro: ${error}, contate o suporte técnico `,
                        type: 'warning',
                        position: 'top-right',
                    });
                   

                });
           },
           toggleAll(checked){
             
               this.selected =  [];
               if(!this.allSelected){
                   for(let i in this.items){
                       this.selected.push(this.items[i].email_user);
                   }
               } 
           },
           assing(e){
               e.preventDefault();
               let currentObj = this;
               axios.post('newsletterAssing/assing/create',{
                   nome_user: this.form.nome_user, email_user: this.form.email_user 
               })
               .then(function(response){
                   Vue.$toast.success('Novo assinante cadastrado',{
                       message: 'Um novo assínante foi cadastrado',
                       type:'success',
                       position: 'top-right',
                   });
                   location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Houve um erro ao cadastrar um novo usuário',{
                        message: 'Erro: ' + this.error + 'Contante o suporte técnico...',
                        type: 'warning',
                        position: 'top-right',
                    });
                });
           },
           sendMail(e)
           {
                e.preventDefault();
                let currentObj = this;
                axios.post('/newsletterAssing/assing/send_mail', { assunto_email: this.form.assunto_email,
                            files_img: this.form.files_img, email_users: this.form.email_users})
                        .then(function(response){
                            Vue.$toast.success('E-mails enviados com sucesso', {
                                message: 'A newsletter foi entregue com sucesso acompanhe na aba "Newsletter enviadas"',
                                type: 'success',
                                position: 'top-right',
                            });
                            location.reload();
                        })
                        .catch(function(error){
                            Vue.$toast.warning('Erro na entrega de E-mails', {
                                message: 'Erro:' + this.error + 'Entre em contato com suporte técnico...',
                                type: 'warning',
                                position: 'top-right',
                            }); 
                        });
           },
           update(item, index, button){
                this.updateModal.title = `Row index: ${index}`
                this.updateModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.updateModal.id, button)
                return this.item = JSON.parse(this.updateModal.content) 
           },
           update_user(e, item)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.item.id;

                axios.put(`/newsletterAssing/assing/update/${id}`,
                { id: id, nome_user: this.form.nome_user,
                     email_user: this.form.email_user})
                     .then(function(response){
                        Vue.$toast.success('As alterações foram realizadas com sucesso...',{
                            message: 'As informações do assinante foram atualizadas com sucesso...',
                            type: 'success',
                            position: 'top-right',
                        })
                        location.reload();
                        //window.alert('Sucesso...');
                     })
                     .catch(function(error){
                         Vue.$toast.warning('Erro, Entre em contanto com o suporte técnico...',{
                             message: 'Algum erro aconteceu, Erro:' + this.error + 'entre em contato com suporte técnico.',
                             type: 'warning',
                             position: 'top-right', 
                         })

                        //window.alert('Error....');
                     });

           },
           remove(item, index, button)
           {
               this.removeModal.title = `Row index: ${index}`
               this.removeModal.content = JSON.stringify(item, null, 2)
               this.$root.$emit('bv::show::modal', this.removeModal.id, button)
               return this.item = JSON.parse(this.removeModal.content)
           },
           destroy_assing(e, item)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.item.id;
               axios.post(`/newsletterAssing/assing/destroy/${id}`, {id: this.form.id})
               .then(function(response){
                   Vue.$toast.success('A Assínatura foi removida com sucesso', {
                       message: 'A assínatura foi removida com sucesso...',
                       type: 'success',
                       position: 'top-right',
                   });
                   location.reload();
               })
               .catch(function(errro){
                   Vue.$toast.warning('Erro ao remover assínatura, Erro: ' + this.error,{
                       message: 'Erro: ' + this.error + 'ao remover assínatura, entre em contato com suporte técnico...',
                       type: 'warning',
                       position: 'top-right',
                   });
               });
           },
           removeHistory(item, index, button)
           {
               this.removeHistoryModal.title=`Row Index: ${index}`
               this.removeHistoryModal.content = JSON.stringify(item, null, 2)
               this.$root.$emit('bv::show::modal', this.removeHistoryModal.id, button)
               return this.item = JSON.parse(this.removeHistoryModal.content)
           },
           destroy_history(e, item) {
               e.preventDefault();
               let currentObj = this;
               var id = this.item.id;

               axios.post(`/newsletterHistory/history/${id}`, {id: this.form.id})
               .then(function(response){
                   Vue.$toast.success('Registro removido com sucesso', {
                       message: 'O registro foi removido do histórico com sucesso...',
                       type: 'success',
                       position: 'top-right',
                   });
                   location.reload();
               })
               .catch(function(error){
                   Vue.$toast.danger('Erro ao remover registro do historico', {
                       message: 'Entre em contato com o suporte técnico, Erro:' + this.error,
                       type: 'danger',
                        position: 'top-right',
                    });
               });

           }
       },
       watch: {
           selected(newVal, oldVal){
                //recebe as mudanças dos usuarios de forma individual
                if(newVal.length == 0)
                {
                    this.indeterminate = false
                    this.allSelected = false
                }               
                else if(newVal.length === this.u_assing.length)
                {
                    this.indeterminate = false
                    this.allSelected = true
                }
                else
                {
                    this.indeterminate = true
                    this.allSelected = false
                }
           }
       },
       mounted(){
           this.items = JSON.parse(this.n_users_assing);
           this.user = JSON.parse(this.user);
           this.img_noticia = JSON.parse(this.img_noticia);
           this.n_history = JSON.parse(this.history); 
           //console.log('Componente montado...');

       }
   }
</script>

