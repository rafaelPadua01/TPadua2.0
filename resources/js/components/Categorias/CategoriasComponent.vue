<template>
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
        <h1 align='center'>Categorias</h1>
        <hr>

        <div>
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Categorias Cadastradas" active>
                        
                        <!-- Filtro de Busca -->
                        <b-input-group size="sm">
                            <b-form-input
                                v-model="filter"
                                type="search"
                                id="filter"
                                :filter="filter"
                                placeholder="Buscador...">

                            </b-form-input>
                        </b-input-group>
                        <br>
                        <div>
                            <b-table
                                stripped
                                hover
                                bordered
                                responsive="sm"
                                :items="categorias"
                                :filter="filter"
                                :fields="fields"
                                :per-page="perPage"
                                :current-page="currentPage"
                                small
                                primary-key='id'>
                                
                                <template v-slot:cell(acoes)="row">
                                    <b-button-group>
                                        <b-button size="sm" class="mr-1" variant="outline-info" @click="update(row.item, row.index, $event.target)">
                                            <b-icon-brush></b-icon-brush>
                                                Atualizar
                                        </b-button>     
                                        <b-button size="sm" class="mr-1" variant="outline-danger" @click="remove(row.item, row.index, $event.target)">
                                            <b-icon-trash2-fill></b-icon-trash2-fill>    
                                                Remover
                                        </b-button>                         
                                    </b-button-group>
                                </template>
                                </b-table>
                        </div>

                        <div class="mt-3">
                            <b-pagination 
                                pills 
                                v-model="currentPage"
                                :total-rows="categorias.length"
                                :per-page="perPage"
                                align='center' >
                            </b-pagination>
                        </div>
                    </b-tab>

                    <b-tab title="Nova Categoria">
                       <b-form @submit="create" method="post">
                          
                           <b-form-group
                            id="form-group-nome-categoria"
                            label="Nome Categoria:"
                            label-for="nome_categoria">
                               <b-form-input
                                id='nome_categoria'
                                type="text"
                                placeholder="Nome categoria aqui"
                                required
                                description="Nome da nova categoria neste campo"
                                v-model="form.nome_categoria">
                                </b-form-input>
                           </b-form-group>
                           
                           <div align='center'>
                                <b-button-group>
                                    <b-button class="mr-1" size="sm" variant="outline-success" type="submit">
                                        <b-icon-check-all></b-icon-check-all>
                                            salvar
                                    </b-button>
                                </b-button-group>
                           </div>
                       </b-form>
                    </b-tab>
                </b-tabs>

            </b-card>
        </div>

        <div class="mt-3">
            <b-modal :id="updateModal.id" :title="updateModal.title" hide-footer>
               <b-form @submit="update_categoria" method="put">
                   <input type="hidden" :v-model="form.id" :value="item.id">
                   <b-form-group
                    id="input-group-nome-categoria"
                    label="Nome categoria:"
                    label-for="nome_categoria">
                        <b-form-input
                            id="nome_categoria"
                            v-model="form.nome_categoria"
                            :placeholder="item.nome_categoria"
                            type="text"
                            required
                            ></b-form-input>
                    </b-form-group>
                    <div align="center">
                        <b-button class="mr-1" size="sm" variant="outline-success" type="submit">
                            
                            <b-icon-check-all></b-icon-check-all>
                            salvar
                        </b-button>
                    </div>
               </b-form>
            </b-modal>
        </div>

        <div class="mt-3">
            <b-modal :id="removeModal.id" :title="removeModal.title" hide-footer>
               Você tem certeza que quer remover está categoria ?
               <br>
               clique no botão 'remover' logo abaixo
               <hr>

                <div align='center'>
                    <b-button class="mr-1" size="sm" variant="outline-danger" @click="destroy">
                        <b-icon-trash2-fill></b-icon-trash2-fill>
                                Remover
                    </b-button>
                </div>
            </b-modal>
        </div>


    </div>
</div>
</template>

<script>
    export default{
        props: ['categorias', 'user'],

        data(){
            return {
                categorias: [],
                filter: null,
                currentPage: 1,
                perPage: 5,
                totalRows: 1,
                item: '',
                
                form: {
                    id: '',
                    id_user: '',
                    nome_categoria: '',
                },
                fields:[
                    {
                        key: 'id',
                        sortable: true,
                    },
                    {
                        key: 'nome_categoria',
                        sortable: true,
                    },
                    {
                        key: 'created_at',
                        sortable: true,
                    },
                    {
                        label: 'Ações',
                        key: 'acoes',
                        sortable: false,
                        stickColumn: true,
                        coltype: 'button',

                    }
                ],

                //Janelas Modais
                updateModal: {
                    id: 'update-modal',
                    title: '',
                    content: '',

                },
                removeModal: {
                    id: 'remove-modal',
                    title: '',
                    content:'',
                }
            }
        },
        computed: {
            sortOptions()
            {
                //Cria uma lista de opcoes com os campos
                return this.fields.fields(f=>f.sortable).map(f=>{
                    return {text: f.label, value: f.key}
                });
            }
        },
        methods:{
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

           update(item, index, button)
           {
               this.updateModal.title = `Row Index: ${index}`
               this.updateModal.content = JSON.stringify(item, null, 2)
               this.$root.$emit('bv::show::modal', this.updateModal.id, button)
               return this.item = JSON.parse(this.updateModal.content)
           },
           remove(item, index, button)
           {
               this.removeModal.title = `Row index: ${index}`
               this.removeModal.content = JSON.stringify(item, null, 2)
               this.$root.$emit('bv::show::modal', this.removeModal.id, button)
                return this.item = JSON.parse(this.removeModal.content)
            },
            create(e)
            {
                e.preventDefault();
                let currentObj = this;
                axios.post(`/categorias/create`, {nome_categoria: this.form.nome_categoria})
                .then(function(response){
                    Vue.$toast.success('Uma nova categoria foi criada',{
                        message: 'Uma nova categoria foi criada com sucesso',
                        type: 'success',
                        position: 'top-right',
                    });

                    location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Erro ao cadastrar nova categoria', {
                        message: 'Não foi possivel cadastrar a nova categoria, Erro:' + this.error + 'Contate o suporte técnico',
                        type: 'warning',
                        position: 'top-right',
                    });
                });

            },
            update_categoria(e, item)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.item.id;

                axios.put(`/categorias/update/${id}`, {id: this.form.id, nome_categoria: this.form.nome_categoria})
                    .then(function(response){
                        Vue.$toast.success('Categoria atualizada com sucesso', {
                            message: 'categoria atualizada com sucesso',
                            type: 'success',
                            position: 'top-right', 
                        });
                        location.reload();
                    })
                    .catch(function(error){
                        Vue.$toast.warning('Não foi possível atualizar a categoria', {
                            message: 'Erro:' + this.error + 'contate o suporte técnico',
                            type: 'warning',
                            position: 'top-right',
                        });
                    });
            },
            destroy(e,item)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.item.id;
                axios.post(`/categorias/destroy/${id}`, {id: this.form.id})
                    .then(function(response){
                        Vue.$toast.success('A categoria foi removida com sucesso...', {
                            message: 'A categoria selecionada foi removida com sucesso',
                            type: "success",
                            position: 'top-right',
                        });
                        location.reload();
                    })
                    .catch(function(error){
                        Vue.$toast.warning('Erro, contate o suporte técnico',{
                            message: 'Error:' + this.error + 'Contate o suporte técnico',
                            type: 'warning',
                            position: 'top-right',
                        });
                    });
            }
        },
        mounted() {
            this.categorias = JSON.parse(this.categorias);
            this.user = JSON.parse(this.user);
        }
    }
</script>