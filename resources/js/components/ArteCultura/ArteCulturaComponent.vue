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

    <!-- Conteudo da pagina -->
    <div class="mt-3">
        <h1 align='center'>Arte & Cultura</h1>
        <hr>

        <div>
            <b-card no-body>
                <!-- Inicia a tab dos Eventos -->
                <b-tabs card>
                    <b-tab title="Eventos" active>
                        <!-- Inicia o conteudo da tab eventos -->
                        <div>
                            <!-- Input Busca de Eventos -->
                            <div class="form-group mt-3">
                                <b-form-input 
                                    class="sm mb-2" 
                                    size="sm" 
                                    type="text" 
                                    placeholder="Buscador de Eventos" 
                                    v-model="s_evento.filter" 
                                ></b-form-input>
                                    <p><b>Você buscou:</b>{{s_evento.filter}}</p>
                            
                            </div>

                            <!-- Inicia a div do card -->
                            <div 
                                class="card"
                                style="width: 18rem; display: inline-block;" 
                                v-for="(a_c, key) in filtered" 
                                :key="key"
                                align='center'
                                >
                                <img :src="a_c.imagem_evento" :alt="a_c.imagem_evento" class="card-img-top">
                                <div class="card-body">
                                    <input type="hidden" name="id" id="id" :v-model="form.id" :value="a_c.id">
                                    <h4 class="card-title" align='center'>{{a_c.nome_evento}}</h4>
                                    <p class="card-text">
                                        {{a_c.descricao_evento}}
                                        <br>
                                        <small><b>Data de upload:</b> {{a_c.data_evento}} <b>Hora:</b> {{a_c.hora_evento}}</small>
                                        

                                    </p>

                                    <div class="btn-group" align='center'>
                                        <b-button class="mr-1" variant="outline-primary" @click="update(a_c, a_c.id, $event.target)">
                                            <b-icon-brush></b-icon-brush>
                                                Editar
                                        </b-button>
                                    
                                        <b-button class="mr-1" variant="outline-danger" @click="remove(a_c, a_c.id, $event.target)">
                                                <b-icon-trash-fill></b-icon-trash-fill>
                                                    Remover
                                        </b-button>

                                        
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- Div Modal Edição do evento -->
                            <div>
                                <b-modal :id="updateModal.id" :title="updateModal.title" hide-footer>
                                    <div class="d-block text-centet">
                                        <b-form @submit="update_arte_cultura" method="post">
                                            <input type="hidden" :v-model="form.id" :value="a_c.id">
                                           

                                            <b-form-group
                                                id="input-group-nome-evento"
                                                label="Nome Evento"
                                                label-for="nome_evento"
                                                description="Defina o nome do Evento"
                                                >
                                                    <b-form-input
                                                        id="nome_evento"
                                                        v-model="form.nome_evento"
                                                        :placeholder="a_c.nome_evento"
                                                        required
                                                    ></b-form-input>
                                            </b-form-group>
                                            <b-form-group
                                                id="input-group-data-evento"
                                                label="Data Evento:"
                                                label-for="data_evento"
                                            >
                                                <b-form-datepicker
                                                    id="data_evento"
                                                    v-model="form.data_evento"
                                                    
                                                    :state="true"
                                                    class="mb-2"
                                                    required
                                                    description="Defina aqui a data do evento"></b-form-datepicker>

                                            </b-form-group>

                                            <b-form-group
                                                id="input-group-hora-evento"
                                                label="Hora do Evento:"
                                                label-for="hora_evento"
                                            >
                                           
                                            <b-form-input-group class="mb-2">
                                                <b-form-input
                                                    id="hora_evento"
                                                    v-model="form.hora_evento"
                                                    :placeholder="a_c.hora_evento"
                                                    type="text"
                                                    required
                                                    size="sm"
                                                ></b-form-input>
                                                
                                            <b-form-group-append>
                                                <b-form-timepicker
                                                v-model="form.hora_evento"
                                                button-only
                                                right
                                                show-seconds
                                                local="en"
                                                aria-controls="example-input"
                                                required
                                                description="Defina a hora deste Evento"
                                                >
                                                </b-form-timepicker>
                                            </b-form-group-append>
                                            </b-form-input-group>
                                            </b-form-group>
                                            <div>
                                                <p><b>Hora do Evento:</b> {{form.hora_evento}}</p>
                                            </div>

                                            <b-form-group
                                                id="input-group-file"
                                                label="Imagem do Evento(Flyer, Banner, Convite e outros...)"
                                                label-for="file"
                                                description="Defina Aqui uma imagem para o novo evento"
                                                ref='file'
                                                v-on:change="onFileUpdate"
                                                
                                            >
                                                <input 
                                                id='file'
                                                type="file" 
                                                ref="file"
                                                v-on:change="onFileUpdate"
                                                :v-model="form.file"
                                                name="file"
                                                drop-placeholder="Arraste-o até aqui"
                                                description="Escolha uma nova imagem para o evento..."
                                                 >
                                            </b-form-group>

                                            <b-form-group
                                                id="input-group-descricao"
                                                label="Descrição do Evento:"
                                                label-for="descricao_evento"
                                            >
                                                <vue-editor 
                                                    
                                                    v-model="form.descricao_evento"
                                                    id="descricao_evento" 
                                                    name="descricao_evento" 
                                                    description='Defina a nova descrição deste evento...'
                                                    aria-required/>
                                            </b-form-group>
                                            <div>
                                              Descrição atual:  <code>{{a_c.descricao_evento}}</code>
                                            </div>
                                            
                                            <hr>
                                            <div align='center'>
                                                <b-button type="submit" variant="success">
                                                    <b-icon-check-all></b-icon-check-all>
                                                    Salvar
                                                </b-button>
                                            </div>
                                        </b-form>
                                    </div>
                                </b-modal>
                            </div>
                            <!-- Div de Remoção do Evento -->
                            <div>
                                <b-modal :id="removeModal.id" title="Remover Galeria" hide-footer>
                                    <div class="d-block text-center">
                                        <!-- Formulário que remove o evento -->
                                        <b-form @submit="destroy_arte_cultura">
                                           <input type="hidden" :v-model="form.id" :value="a_c.id">
                                           <p align='cwenter'><b>{{a_c.nome_evento}}</b></p>
                                           <p>Você tem certeza que gostaria de remover este evento?
                                                <br>
                                                
                                            </p>
                                           <p>Clique no botão vermelho
                                               <b-button variant="outline-danger">
                                                    <b-icon-trash-fill></b-icon-trash-fill>
                                                    Remover
                                                </b-button>
                                                para confirmar e remover</p>

                                           <hr>
                                           <b-button-group>
                                               <b-button class="mt-3" variant="outline-danger" type="submit">
                                                   <b-icon-trash-fill></b-icon-trash-fill>
                                                        Remover
                                                </b-button>
                                           </b-button-group>
                                        </b-form>
                                    </div>
                                </b-modal>
                            </div>
                        </div>
                        <!-- Paginação -->
                        <div align='center'>
                            <b-pagination variant='success' v-model='currentPage' class="mt-3" pills :total-rows="a_c.length" align='center'></b-pagination>
                        </div>
                    </b-tab>

                <!-- Fim da tab eventos -->   

                    <!-- Tab do formulário de cadastro -->
                    <b-tab title="Formulário de Cadastro">
                        
                        <!-- Inicia o Formulário -->
                        <b-form @submit="store" method="post">
                        
                        <b-form-group
                            id="input-group-0"
                            label="Usuario:"
                            label-for="input-1"
                        
                        >
                        <b-form-select  id="input-1" v-model="form.id_user" required>
                            <template v-slot:first>
                                <b-form-select-option :value="null" disabled>{{user.name}}</b-form-select-option>
                            </template>
                            <b-form-select-option
                            :value="user.id"
                            >
                                {{user.name}}
                            </b-form-select-option>
                        </b-form-select>
                        </b-form-group>  
                         
                            <!-- Primeiro Grupo de inputs -->
                            <b-form-group
                                id="input-group-1"
                                label='Nome Evento'
                                label-for='nome_evento'
                                description="Defina aqui o nome do evento"
                            >
                            <!-- Input do nome do evento -->
                            
                            <b-form-input
                                id="nome_evento"
                                v-model="form.nome_evento"
                                type="text"
                                required
                                placeholder="Nome do Evento aqui...">
                            </b-form-input>
                        </b-form-group>
                        
                        <!-- segundo grupo de eventos -->
                        <b-form-group 
                            id="input-group-2"
                            label="Data Evento"
                            label-for="data_evento"
                            description="Denina a data deste evento"
                        >
                        <!-- Input da data do evento-->
                        <b-form-datepicker
                            id="data_evento"
                            v-model="form.data_evento"
                            required
                            placeholder="data do evento aqui"
                            :state="true"
                            class="mb-2"
                            aria-required="true"
                        ></b-form-datepicker>

                        </b-form-group>

                        <!-- terceiro Grupo de inputs -->
                        <b-form-group
                            id="input-group-3"
                            label="Hora Evento"
                            label-for="hora_evento"
                            description="Defina a hora deste evento">
                        <b-input-group class="mb-3">
                            <b-form-input
                            id="hora_evento"
                            v-model="form.hora_evento"
                            type="text"
                            aria-placeholder="HH:mm:ss"
                            required
                            ></b-form-input>
                            <b-form-input-group-append>
                                <b-form-timepicker
                                    v-model="form.hora_evento"
                                    button-only
                                    right
                                    show-seconds
                                    local="en"
                                    aria-controls="example-input"
                                    required
                                ></b-form-timepicker>
                            </b-form-input-group-append>
                            
                        </b-input-group>
                        <div>
                            <p><b>Hora:</b> '{{form.hora_evento}}'</p>
                        </div>
                        </b-form-group>

                       <!-- quarto grupo de Inputs -->
                       <b-form-group
                        id="input-group-4"
                        label="Imagem do Evento(Flyer, Banner, Convite e outros...)"
                        label-for="file"
                        description="Defina Aqui uma imagem para o novo evento"
                        ref='file'
                        v-on:change="onFileChange"
                       
                        >
                        <!-- Input de arquivo para a imagem do evento-->
                       <input 
                                type="file"
                                id="file"
                                :v-model="form.file"
                                placeholder="Selecione o arquivo ou arraste-o até aqui..."
                                drop-placeholder="Arraste até aqui..."
                                ref="file"
                                name="file"
                                v-on:change="onFileChange">

                        <!--<b-form-file
                            id="file"
                            v-model="form.file"
                            :state="Boolean(file)"
                            placeholder="Selecione o arquivo ou arraste-o até aqui..."
                            drop-placeholder="Arraste até aqui..."
                        ></b-form-file> -->

                        

                       </b-form-group>
                      

                       <!-- Quinto grupo de inputs -->
                       <b-form-group
                        id="input-group-5"
                        label="Descrição do evento:"
                        label-for="descricao_evento"
                        description="Descricreva o Envento... ">
                        
                            <vue-editor v-model="form.descricao_evento" id="descricao_evento" name="descricao_evento" aria-required/>
                
                        </b-form-group>
                        <div>
                            <p style='white-space : pre-line'><b>Descrição do Evento</b> <code>{{form.descricao_evento}}</code></p>
                        </div>
                        <div class="mt-3" align='center'>
                            <b-button-group>
                                <b-button type="submit" variant='success'>
                                    <b-icon-check-circle></b-icon-check-circle>
                                        Salvar
                                </b-button>
                            </b-button-group>
                        </div>
                        
                        </b-form>
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
    </div>
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
    import {VueEditor} from "vue2-editor";
    export default{
       props: ['user', 'arte_cultura'],

        components: {
            VueEditor,
        },
        data(){
            return {
                file: '',
                a_c: '',
                content: '',
                currentPage: 1,
                rows: 1,
                perPage: 5,
                form: {
                    id: '',
                    id_user: '',
                    nome_evento: '',
                    data_evento: '',
                    hora_evento: '',
                    file: null,
                    descricao_evento: '',
                    
                },

                //Variaveis dos filtros
                s_evento: {
                    orderBy: 'stargazers_count',
                    order: 'desc',
                    filter: '',
                },
                
                //Janelas Modais
                updateModal: {
                    id: 'update-modal',
                    title: '',
                    content: '',
                },
                removeModal: {
                    id: 'remove-modal',
                    title: '',
                    content: '',
                }
            }
        },

        //Methodos computados
        computed: {
            //Metodo que filtra os eventos
            filtered(){
                const filter = this.s_evento.filter;
                const f_evento = _.orderBy(this.arte_cultura, this.s_evento.orderBy, this.s_evento.order);
                if(_.isEmpty(filter)){
                    return f_evento;
                }
                
                return _.filter(f_evento, a_c => this.a_c.indexOf(filter) >= 0);
            },
        },

        methods: {
            logout(e){
                e.preventDefault();
                axios.post('/logout')
                .then(function(response){
                    Vue.$toast.success('Logout Realizado com sucesso...', {
                        message: 'Você foi deslogado com sucesso...',
                        type: 'success',
                        position: 'top-right',
                    });
                    location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Erro ao efetuar logout...', {
                        message: 'errro ao efetuar logout, contate o suporte técninco',
                        type: 'warning',
                        position: 'top-right',
                    });
                });
            },
           
             onContext(ctx){
                this.context = ctx
            },

            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            //Metodo que envia os dados de cadastro para API
            store(e){
                e.preventDefault();
                let currentObj = this;
                const config = {
                    headers: {
                        'content-type' : 'multipart/form-data'
                    }
                }

                let formData = new FormData();
                formData.append('id_user', this.form.id_user);
                formData.append('file', this.file);
                formData.append('nome_evento', this.form.nome_evento);
                formData.append('data_evento', this.form.data_evento);
                formData.append('hora_evento', this.form.hora_evento);
                formData.append('descricao_evento', this.form.descricao_evento);

                axios.post(`/arte_cultura/create`, formData, config, 
                    {id_user: this.form.id_user, nome_evento: this.form.nome_evento, 
                        data_evento: this.form.data_evento, hora_evento: this.form.hora_evento, 
                            file: this.form.file, descricao_evento: this.form.descricao_evento
                    })
                    .then(function(response){
                        Vue.$toast.success('Evento criado com sucesso...', {
                            message: 'O evento foi criado sucesso...',
                            type: 'success',
                            position: 'top-right'
                        });
                        location.reload();
                       // console.log('success');
                    })
                    .catch(function(error){
                         Vue.$toast.warning('Não foi possível criar o evento..', {
                            message: 'Erro ao criar o evento, contate o suporte técnico' + this.error,
                            type: 'warning',
                            position: 'top-right'
                        });
                       // console.log('error');
                    });
            },
            handleFileUpload()
            {
                this.file = this.$refs.file.files[0];
            },
             onFileUpdate(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            //Methodo de atualização do evento
            update_arte_cultura(e, a_c){
                e.preventDefault();
                let currentObj= this;
                var id =  this.a_c.id
                const config = {
                    headers: {
                        'content-type' : 'multipart/form-data' 
                    }
                }

                let formDataUpdate =  new FormData();
                formDataUpdate.append('id', this.form.id);
                formDataUpdate.append('id_user', this.form.id_user);
                formDataUpdate.append('nome_evento', this.form.nome_evento);
                formDataUpdate.append('data_evento', this.form.data_evento);
                formDataUpdate.append('hora_evento', this.form.hora_evento);
                formDataUpdate.append('file', this.file);
                formDataUpdate.append('descricao_evento', this.form.descricao_evento);

                axios.post(`/arte_cultura/update/${id}`, formDataUpdate, config, {
                    id: this.form.id, id_user: this.form.id_user, nome_evento: this.form.nome_evento,
                    data_evento: this.form.data_evento, hora_evento: this.form.hora_evento, file: this.form.file,
                    descricao_evento: this.form.descricao_evento
                })
                .then(function(response){
                    Vue.$toast.success('Evento Atualizado com sucesso...',{
                        message: 'O Evento Foi Atualizado...',
                        type: 'success',
                        position: 'top-right'

                    });
                    location.reload();  
                    //console.log(response);
                })
                .catch(function(error){
                    Vue.$toast.warning('Erro Ao atualizar evento', {
                        message: 'Erro ao atualizar o evento, contate o suporte técnico' + `${error}`,
                        type: 'warning',
                        position: 'top-right'
                    }); 
                    //console.log(error)
                });
                
            },
            handleFileUpdate()
            {
                this.file = this.$refs.file.files[0];
            },
            //Metodo que remove o evento
            destroy_arte_cultura(e, a_c)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.a_c.id;
                
                axios.post(`/arte_cultura/destroy/${id}`,{
                    id: this.form.id
                })
                .then(function(reponse){
                    Vue.$toast.success('O evento foi removido...',{
                        message: 'O evento foi removido com sucesso',
                        type: 'success',
                        position: 'top-right',
                    });
                        location.reload();
                    //console.log(response)
                }).catch(function(error){
                    Vue.$toast.warning('Não foi possivel remover o evento...', {
                        message: `O evento não pode ser removido, contate o suporte técnico, Erro: ${erro}`,
                        type: "warning",
                        position: 'top-right',
                    });
                    //console.log(error)
                });
            },

            //Metodos das janelas modais
            update(a_c, button)
            {
                this.updateModal.title = `Row index: ${a_c.id}`
                this.updateModal.content = JSON.stringify(a_c, null, 2)
                this.$root.$emit('bv::show::modal', this.updateModal.id, button)
                return this.a_c = JSON.parse(this.updateModal.content)
            },
            setEditorContent(a_c){
                this.content = a_c.descricao_evento;
                
            },
            remove(a_c, button)
            {
                this.removeModal.title = `Row index: ${a_c.id}`
                this.removeModal.content = JSON.stringify(a_c, null, 2)
                this.$root.$emit('bv::show::modal', this.removeModal.id, button)
                return this.a_c = JSON.parse(this.removeModal.content)
            }
        },

        mounted() {
            this.user = JSON.parse(this.user); 
            this.arte_cultura = JSON.parse(this.arte_cultura);
            //console.log('component mounted');

        }
    }

</script>