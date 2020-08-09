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
<!--Conteudo da Página -->
    <b-container>
        <b-row>
            <b-col></b-col>
            <b-col cols="12">
                <div>
                    <p class="h1" align='center'>Comentários e Respostas</p>
                    <hr>
                </div>
            </b-col>
            <b-col></b-col>
        </b-row>

        <b-row>
            <b-col></b-col>
            <b-col cols="12">
                <div>
                    <b-card title="Card Title" no-body>
                        <b-tabs card>
                            <div>
                                <b-tab title="Comentarios" active>
                                    <div>
                                        <b-input-group size='sm'>
                                            <b-form-input
                                             v-model="filter" 
                                             type="search"
                                             placeholder="buscador de comentários"
                                             id="filterInput"
                                             :filter="filter">
                                            
                                            </b-form-input> 
                                             
                                            <b-form-group-append>
                                                <b-button 
                                                    class="mr-1" 
                                                    size="sm" 
                                                    :disabled="!filter" 
                                                    @click="filter = ''" 
                                                    variant="outline-secondary"
                                                >
                                                    
                                                        Limpar Busca...
                                                </b-button>     
                                            </b-form-group-append>   

                                        </b-input-group> 
                                        <b-table 
                                            striped
                                            hover
                                            bordered
                                            :items="comentarios"
                                            :fields="fields"
                                            :filter="filter"
                                            :per-page="perPage"
                                            :current-page="currentPage"
                                            :sort-by-sync="sortBy"
                                            :sort-desc.sync="sortDesc"
                                            responsive="sm"
                                            small
                                            primary-key="id"
                                        >

                                            <template v-slot:cell(acoes)='row'>
                                                <b-button-group>
                                                    <b-button 
                                                        class="mr-1" 
                                                        size="sm" 
                                                        variant="danger" 
                                                        @click="remove(row.item, row.index, $event.target)"
                                                    >
                                                        <b-icon-trash-fill></b-icon-trash-fill>
                                                            Remover
                                                    </b-button>
                                                </b-button-group>
                                            </template>
                                        </b-table>
                                        <div class="mt-3">
                                            <b-pagination 
                                                v-model="currentPage" 
                                                pills 
                                                :total-rows="comentarios.length" 
                                                :per-page="perPage" 
                                                align="center">
                                            </b-pagination>
                                        </div>

                                    </div>
                                </b-tab>
                            </div>
                            <div>
                                <b-tab title="Respostas">

                                <b-input-group size='sm'>
                                            <b-form-input
                                             v-model="filter_resposta" 
                                             type="search"
                                             placeholder="buscador de Resposta"
                                             id="filter_resposta"
                                             :filter="filter_resposta">
                                            
                                            </b-form-input> 
                                             
                                            <b-form-group-append>
                                                <b-button class="mr-1" size="sm" :disabled="!filter_resposta" @click="filter_resposta = ''" variant="outline-secondary">Limpar busca</b-button>     
                                            </b-form-group-append>
                                </b-input-group>
                                <b-table 
                                    striped 
                                    hover
                                    bordered
                                    :items="respostas"
                                    :filter="filter_resposta"
                                    :fields="fields_respostas"
                                    :per-page="perPage"
                                    :current-page="currentPage"
                                    :sort-by-sync="sortBy"
                                    :sort-desc.sync='sortDesc'
                                    responsive="sm"
                                    small 
                                    primary-key="id"
                                >
                                <template v-slot:cell(acoes_resposta)='row'>
                                    <b-button-group>
                                        <b-button class="mr-1" size="sm" variant="danger" @click="remove_resposta(row.item, row.index, $event.target)">Remover</b-button>
                                    </b-button-group>
                                </template>
                                    
                                </b-table>
                                
                                <div class="mt-3">
                                    <b-pagination
                                        :v-model="currentPage"
                                        pills 
                                        :total-rows="respostas.length"
                                        :per-page="perPage"
                                        align='center'>
                                    </b-pagination>
                                </div>
                            
                        </b-tab>
                        </div>
                        <div>
                            <b-tab title="Denuncias de comentarios">
                                <b-input-group size='sm'>
                                            <b-form-input
                                             v-model="filter_denuncias" 
                                             type="search"
                                             placeholder="buscador de Denuncias"
                                             id="filter_denuncias"
                                             :filter="filter_denuncias">
                                            
                                            </b-form-input> 
                                             
                                            <b-form-group-append>
                                                <b-button class="mr-1" size="sm" :disabled="!filter_denuncias" @click="filter_denuncias = ''" variant="outline-secondary">Limpar busca</b-button>     
                                            </b-form-group-append>
                                </b-input-group>

                                <b-table 
                                    responsive="sm"
                                    striped
                                    hover
                                    bordered
                                    :fields="fields_denuncias"
                                    :items="denuncias"
                                    :filter="filter_denuncias"
                                    :per-page="perPage"
                                    :current-page="currentPage"
                                    :sort-by-sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    small
                                    primary-key="id"
                                >
                                 <template v-slot:cell(acoes_denuncias)='row'>
                                    <b-button-group>
                                        <b-button class="mr-1" size="sm" variant="danger" @click="remove_denuncias(row.item, row.index, $event.target)">Remover</b-button>
                                    </b-button-group>
                                </template>

                                </b-table>

                                <div class="mt-3">
                                    <b-pagination
                                        :v-model="currentPage"
                                        pills 
                                        :total-rows="denuncias.length"
                                        :per-page="perPage"
                                        align='center'>
                                    </b-pagination>
                                </div>
                            </b-tab>
                        </div>

                        <div>
                            <b-tab title="Denuncias de Respostas">
                                 <b-input-group size='sm'>
                                            <b-form-input
                                             v-model="filter_denuncias_r" 
                                             type="search"
                                             placeholder="buscador de Denuncias"
                                             id="filter_denuncias"
                                             :filter="filter_denuncias_r">
                                            
                                            </b-form-input> 
                                             
                                            <b-form-group-append>
                                                <b-button class="mr-1" size="sm" :disabled="!filter_denuncias_r" @click="filter_denuncias_r = ''" variant="outline-secondary">Limpar busca</b-button>     
                                            </b-form-group-append>
                                </b-input-group>
                                <b-table 
                                    responsive="sm"
                                    striped
                                    hover
                                    bordered
                                    :fields="fields_denuncias_r"
                                    :items="denuncias_r"
                                    :filter="filter_denuncias_r"
                                    :per-page="perPage"
                                    :current-page="currentPage"
                                    :sort-by-sync="sortBy"
                                    :sort-desc.sync="sortDesc"
                                    small
                                    primary-key="id"
                                >
                                 <template v-slot:cell(acoes_denuncias_r)='row'>
                                    <b-button-group>
                                        <b-button class="mr-1" size="sm" variant="danger" @click="remove_denuncias_r(row.item, row.index, $event.target)">Remover</b-button>
                                    </b-button-group>
                                </template>

                                </b-table>

                                <div class="mt-3">
                                    <b-pagination
                                        :v-model="currentPage"
                                        pills 
                                        :total-rows="denuncias_r.length"
                                        :per-page="perPage"
                                        align='center'>
                                    </b-pagination>
                                </div>
                            </b-tab>
                        </div>

                        </b-tabs>

                    </b-card>
                    
                    
                </div>
                <!-- Janelas Modais -->
                <!-- Modal de remoção dos comentarios -->
                <div>
                    <b-modal centered :id="removeModal.id" :title="removeModal.title" hide-footer>
                        <b-form @submit="destroyComent" method="post">
                            <input type="hidden" :v-model="form.email_user_coment" :value="item.email_user_coment">
                            <p>Você tem certeza que deseja remover este comentario pertecente ao usuario e suas respostas ???</p>
                            
                            <div align='center'>
                                <b-button type="submit" class="mr-1" size="sm" variant="danger">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                        Remover
                                </b-button>
                            </div>
                        </b-form>
                    </b-modal>
                </div>
                <!-- Modal remoção das Respostas -->
                <div>
                    <b-modal :id="removeRespostaModal.id" :title="removeRespostaModal.title" hide-footer centered>
                        <b-form @submit="destroyResp" method="post">
                            <p>Você tem certeza que deseja remover esta resposta ???</p>
                            
                            <div align='center'>
                                <b-button type='submit' variant="danger" class="mr-1" size="sm">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                        Remover
                                </b-button>
                            </div>
                        </b-form>
                    </b-modal>
                </div>

                <!-- Modal remoção das Denuncias -->
                <div>
                    <b-modal :id="removeDenunciasModal.id" :title="removeDenunciasModal.title" hide-footer centered>
                        <b-form @submit="destroyDenuncia" method="post">
                            <p>Você tem certeza que deseja remover esta denuncia ???</p>
                            
                            <div>
                                <b-button type="submit" class="mr-1" size="sm" variant="danger">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                        Remover
                                </b-button>
                            </div>
                        </b-form>
                    </b-modal>
                </div>

                
                <!-- Modal remoção das Denuncias das respostas -->
                <div>
                    <b-modal :id="removeDenunciasRespModal.id" :title="removeDenunciasRespModal.title" hide-footer centered>
                        <b-form @submit="destroyDenunciaResp">
                            <p>Você tem certeza que deseja remover esta denuncia ???</p>
                            
                            <div align="center">
                                <b-button type="submit" class="mr-1" size="sm" variant="danger">
                                    <b-icon-trash-fill></b-icon-trash-fill>
                                        Remover
                                </b-button>
                            </div>
                        </b-form>
                    </b-modal>
                </div>

            </b-col>
            <b-col></b-col>
        </b-row>
    </b-container>
    </div>
</template>

<script>
export default{
    props: ['user', 'comentarios', 'respostas', 'denuncia', 'denuncia_r'],
    data(){
        return {

            form: {
                email_user_coment: '',
                email_user_coment_reply: '',
            },
            item: '',
            totalRows: 1,
            currentPage: 1,
            perPage: 5,
            filter: null,
            filter_resposta: null,
            filter_denuncias: null,
            filter_denuncias_r: null,

            //Define qual o campo da tabela será usaado como parametro para a ordernação
            sortBy: 'id',
            sortDirection: 1,
            sortDesc: true,

            //Janelas Modais
            removeModal: {
                id: 'remove-modal',
                title: '',
                content: '',
            },
            removeRespostaModal: {
                id: 'remove-resposta-modal',
                title: '',
                content: '',
            },
            removeDenunciasModal: {
                id: 'remove-denuncias-modal',
                title: '',
                content: '',
            },
            removeDenunciasRespModal:{
                id: "remove-denuncias-resp-modal",
                title: '',
                content: '',
            },

            remove(item, index, button){
                this.removeModal.title = `Row index: ${item.id}`,
                this.removeModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.removeModal.id, button)
                return this.item = JSON.parse(this.removeModal.content)

            },
            remove_resposta(item, index, button){
                this.removeRespostaModal.title = `Row index: ${item.id}`
                this.removeRespostaModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.removeRespostaModal.id, button)
                return this.item = JSON.parse(this.removeRespostaModal.content)
            },
            remove_denuncias(item, index, button)
            {
                this.removeDenunciasModal.title = `Row index: ${item.id}`
                this.removeDenunciasModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.removeDenunciasModal.id, button)
                return this.item = JSON.parse(this.removeDenunciasModal.content)
            },
            remove_denuncias_r(item, index, button)
            {
                this.removeDenunciasRespModal.title = `Row index: ${item.id}`
                this.removeDenunciasRespModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.removeDenunciasRespModal.id, button)
                return this.item = JSON.parse(this.removeDenunciasRespModal.content)
            },

            fields: [
                {
                    key: 'id',
                    sortable: true,
                },
                {
                    key: 'id_noticia',
                    sortable: true,
                },
                {
                    label: 'Comentario',
                    key: 'content_coment',
                    sortable: true,
                    

                },
                {
                    label: 'Email usuario',
                    key: 'email_user_coment',
                    sortable: true,

                },
                {
                    label: 'Ações',
                    key: 'acoes',
                    sortable: false,
                    stickcolumn: true,
                    coltype: 'button',
                }

            ],
            fields_respostas:[
                {
                    key: 'id',
                    sortable: true,
                },
                {
                    key: 'id_noticia',
                    sortable: true,

                },
                {
                    key: 'id_comentario',
                    sortable: true,
                },
                {
                    label: 'nome usuario',
                    key:'nome_user_coment_reply',
                    sortable: true,
                },
                {
                    label: 'email usuario',
                    key: 'email_user_coment_reply',
                    sortable:true,
                },
                {
                    label: 'comentario',
                    key: 'content_coment_reply',
                    sortable: true,

                },
                {
                    label: 'Açoes',
                    key: 'acoes_resposta',
                    sortable: false,
                    stickcolumn: true,
                    coltype: 'button',
                }
            ],
            fields_denuncias: [
                {
                    key: 'id',
                    sortable: true,
                },
                {
                    key: 'id_comentario',
                    sortable: true,
                },
                {
                    key: 'id_noticia',
                    sortable: true,
                },
                {
                    label: 'nome usuario denunciante',
                    key: 'nome_user_denuncia',
                    sortable: true,

                },
                {
                    label: 'email usuario denunciante',
                    key: 'email_user_denuncia',
                    sortable: true,
                },
                {
                    label: 'Denuncia',
                    key: 'denuncia',
                    sortable: true,
                },
                {
                    label: 'data da denuncia',
                    key: 'created_at',
                    sortable: true,
                },
                {
                    label: 'Ações',
                    key: 'acoes_denuncias',
                    sortable: false,
                    stickcolumn: true,
                    coltype: 'button',
                }
            ],
            fields_denuncias_r: [
                {
                    key: 'id',
                    sortable: true,
                },
                {
                    key: 'id_resposta',
                    sortable: true,
                },
                {
                    label: 'email do usuario',
                    key: 'email_denuncia_reply',
                    sortable: true,
                },
                {
                    label: 'Denuncia',
                    key: 'denuncia',
                    sortable: true,

                },
                {
                    label: 'data da denuncia',
                    key: 'created_at',
                    sortable: true,
                },
                
                {
                    label: 'Ações',
                    key: 'acoes_denuncias_r',
                    sortable: false,
                    stickcolumn: true,
                    coltype: 'button',
                }
            ],

            

            
        }
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
           destroyNotifications(){
                axios.get('/notifications/destroy')
                .then(response => this.notifications = response.data.notifications)
            },
           destroyComent(e)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.item.id;
               
               axios.post(`/comment/destroyadmin/${id}`)
               .then(function(response){
                   Vue.$toast.success('Comentario Removido com sucesso', {
                       header: 'O comentário foi removido com sucesso...',
                       message: 'O comentario foi removido de nossa base de dados',
                       type: 'success',
                       position: 'top-right',
                   });

                   location.reload();
               })
               .catch(function(error){
                   if(error.response.status == 500)
                   {
                        Vue.$toast.info('Erro 500',{
                        message: 'Este comentário possui uma denuncia, remova esta denuncia primeiro...',
                        type: 'info',
                        position: 'bottom-right',
                        duration: 6000,
                        pauseOnHover: true,
                        });   
                   }
                   else
                   {
                        Vue.$toast.warning({
                        header: 'Não foi possivel remover o comentário selecionado',
                        message: 'Contate o suporte técnico Erro:' + error + '...',
                        type: 'warning',
                        position: 'top-right',
                        duration: 6000,
                        pauseOnHover: true,
                        });
                   }
               })
           },
           destroyResp(e)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.item.id;
               axios.post(`/reply/destroyadmin/${id}`)
               .then(function(response){
                   Vue.$toast.success('Comentario Removido com sucesso', {
                       message: 'A resposta foi removido de nossa base de dados',
                       type: 'success',
                       position: 'top-right',
                   });

                   location.reload();
               })
               .catch(function(error){
                   Vue.$toast.warning({
                        message: 'Contate o suporte técnico Erro:' + error + '...',
                        type: 'warning',
                        position: 'top-right',
                        duration: 6000,
                        pauseOnHover: true,
                        });
               });
           },
           destroyDenuncia(e)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.item.id;
               axios.post(`/denuncia/destroy/${id}`)
               .then(function(response){
                   Vue.$toast.success('A Denuncia foi Removido com sucesso', {
                       header: 'A denuncia foi removida com sucesso...',
                       message: 'A Denuncia foi removida de nossa base de dados',
                       type: 'success',
                       position: 'top-right',
                   });

                   location.reload();
               })
               .catch(function(error){
                   Vue.$toast.warning('Erro ao remover', {
                       header: 'Não foi possivel remover a denuncia selecionado',
                       message: 'Contate o suporte técnico Erro:' + error + '...',
                       type: 'warning',
                       position: 'top-right',
                   });
               });
           },
           
           destroyDenunciaResp(e)
           {
               e.preventDefault();
               let currentObj = this;
               var id = this.item.id;
               axios.post(`/denuncia_reply/destroy/${id}`)
               .then(function(response){
                   Vue.$toast.success('A Denuncia foi Removido com sucesso', {
                       header: 'A denuncia foi removida com sucesso...',
                       message: 'A Denuncia foi removida de nossa base de dados',
                       type: 'success',
                       position: 'top-right',
                   });

                   location.reload();
               })
               .catch(function(error){
                   Vue.$toast.warning('Erro ao remover', {
                       header: 'Não foi possivel remover a denuncia selecionado',
                       message: 'Contate o suporte técnico Erro:' + error + '...',
                       type: 'warning',
                       position: 'top-right',
                   });
               });
           }
    },
    computed: {
        sortOptions(){
            //Cria a lista de opções dos campos
            return this.fields 
            .fields(f=>f.sortable)
            .map(f=>{
                return {text: f.label, value: f.key}
                });
            },
        sortOptionsResposta(){
            //Cria a lista de opções dos campos
            return this.fields_respostas
            .fields(f=>f.sortable)
            .map(f=>{
                return {text: f.label, value: f.key}
            });
        },
        sortOptionsDenuncias(){
            return this.fields_denuncias
            .fields(f=>f.sortable)
            .map(f=>{
                return {text: f.label, value: f.key}
            });
        },
        sortOpionsDenunciasRespostas()
        {
          return this.fields_denuncias_r
          .fields(f=>f.sortable)
          .map(f=>{
              return {text: f.label, value: f.key}
          });
        },
        notifications(){
                return this.notifications
            },

    },
       
    mounted() {
        this.user = JSON.parse(this.user);
        this.comentarios = JSON.parse(this.comentarios);
        this.respostas = JSON.parse(this.respostas);
        this.denuncias = JSON.parse(this.denuncia);
        this.denuncias_r = JSON.parse(this.denuncia_r);
        this.destroyNotifications();
    }    
}

    
</script>

<style></style>