<template>
    <div>
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

        <b-container class="lg">
            <b-row>
                <b-col></b-col>
                <b-col cols="8">
                    <template>
                        <div>
                            <b-card 
                                tag='article'
                                class="mb-2"
                                border-variant="info"
                                style="max-width: 80rem"
                            >

                            <b-card-text>
                                <p class="h1" align='center' style="color: #17a2b8">{{noticia.titulo}}</p>
                               
                                <p v-html="noticia.content.substr(0, 50) + '...'" ></p>
                                <p><small><b>{{noticia.created_at}}</b></small></p>
                                 <hr>
                                   
                                 <template v-for="n_img in img" :v-if="n_img.id_noticia === noticia.id" centered>
                                   <b-card-img-lazy :src="'../../../' + n_img.nome_imagem" :alt="n_img.nome_imagem" fluid v-bind:key="n_img.id"></b-card-img-lazy>
                                 </template>

                                
                                <template>
                                    <div v-html="noticia.content" class="mt-3 justify-content-center"></div>
                                </template>
                            </b-card-text>

                            </b-card>
                            <br>
                            <hr> 
                        <div>
                            <p><b>Comentarios:</b> ({{comentarios.count}})</p> 
                            <template v-for="n_coment in limitedComentarios" :v-if="n_coment.id_noticia === noticia.id">
                                <ul style="list-style: none; margin-left: 0%" v-bind:key="n_coment.id">
                                    <li>
                                        <div>
                                            <b-card tag="deck" class="mb-2">
                                                <b-card-text>
                                                    
                                                    <p><span v-html="n_coment.content_coment"></span>
                                                    
                                                        <small style="float: right; color: gray">
                                                            <label><b>Autor:</b></label>{{n_coment.nome_user_coment}}
                                                            <b>Em : </b>{{n_coment.created_at}}
                                                        </small>
                                                    </p>
                                                    <br>
                                                    <hr>
                                                    <b-button-group>
                                                        <b-button class="mr-1" size="sm"  @click="removeComent(n_coment, $event.target)" variant="link">
                                                            <b-icon-trash></b-icon-trash>
                                                            Remover
                                                        </b-button>
                                                        
                                                        <b-button class="mr-1" size="sm" variant="link" @click="reply(noticia, n_coment, $event.target)">
                                                            <b-icon-reply></b-icon-reply>
                                                                Responder
                                                        </b-button>
                                                        <b-button class="mr-1" size="sm" variant="link" @click="denuncia(n_coment, $event.target)">
                                                            <b-icon-exclamation-circle size="sm" variant="danger"></b-icon-exclamation-circle>
                                                                Denunciar
                                                        </b-button>
                                                    </b-button-group>
                                                    <hr>
                                                    <!-- Aqui vou carregar as repostas -->
                                                    <template v-for="c_r in respostas">
                                                    <ul style="list-style: none" v-bind:key="c_r.id" v-if="c_r.id_noticia === noticia.id && c_r.id_comentario === n_coment.id">
                                                        <li>
                                                            <b-card tag="deck">
                                                                <b-card-text>
                                                                    <p><span v-html="c_r.content_coment_reply"></span></p>
                                                                    
                                                                    <p>
                                                                        <small style="float: right; color: gray">
                                                                        <label><b>Autor:</b></label> {{c_r.nome_user_coment_reply}}
                                                                            <b>Em</b>{{c_r.created_at}}
                                                                    </small>
                                                                    </p>
                                                                    <br>
                                                                    <hr>
                                                                    <b-button-group>
                                                                        <b-button class="mr-1" size="sm" variant="link" @click="removeReply(c_r, $event.target)">
                                                                            <b-icon-trash></b-icon-trash>
                                                                            Remover
                                                                        </b-button>
                                                                        <b-button class="mr-1" size="sm" variant="link" @click="denunciaReply(c_r, $event.target)">
                                                                            <b-icon-exclamation-circle size="sm" variant="danger"></b-icon-exclamation-circle>
                                                                                Denunciar
                                                                        </b-button>
                                                                    </b-button-group>
                                                                </b-card-text>
                                                            </b-card>    
                                                        </li>
                                                        <ul :v-else-if="c_r.id_noticia !== noticia.id && c_r.id_comentario !== n_coment.id">
                                                            
                                                         </ul>
                                                    </ul>
                                                    
                                                    </template>
                                                    
                                                    <br>
                                                </b-card-text>
                                            </b-card>

                                            
                                            
                                        </div>
                                    </li>
                                   
                                </ul>
                            </template>
                            <div>
                            <b-button variant="outline-info" align='center' size="lg" class="mr-1"  block @click="limitComentarios += 3">
                                <b-icon-plus></b-icon-plus>
                                    Veja mais...
                              </b-button>
                              </div>
                            
                            <!-- Janela Modal RemoveComent -->
                            <b-modal :id="removeModal.id" :title="removeModal.title" hide-footer centered>
                                <b-form @submit="destroyComent" method="post">
                                    <label for='input-name'>Seu Email:</label>
                                    <input type="email" v-model="form.email_user_coment" placeholder="seu email aqui..." required>
                                    <p>Apenas o autor deste comentário estará autorizado a remove-lo</p>
                                    <b-button type="submit" class="mr-1" size='sm' variant='info'>Remover</b-button>
                                </b-form>
                            </b-modal>
                            <!-- fim desta modal -->

                            <!--Janela Modal reply -->
                            <b-modal :id="replyModal.id" :title="replyModal.title" hide-footer centered>
                                <b-form inline @submit="storeReply" method="post">
                                    <b-input-group>
                                        <label description="Seu nome neste campo...">Seu Nome:</label>
                                            <b-form-input 
                                                type="text"
                                                placeholder="Seu nome aqui..."
                                                v-model="form.nome_user_coment_reply" 
                                                required >
                                            </b-form-input>

                                        <label description="Seu email neste campo...">Seu Email:</label>
                                            <b-form-input 
                                                type="email" 
                                                placeholder="Seu email aqui..."
                                                v-model="form.email_user_coment_reply" 
                                                required>
                                            </b-form-input>
                                    </b-input-group>

                                                    <div>
                                                        <b-container fluid>
                                                            <b-row class="mt-2">
                                                                <b-col sm="2">
                                                                    <label for="textarea-large" description="Insira sua resposta neste campo...">
                                                                        Resposta:
                                                                    </label>
                                                                </b-col>

                                                                <b-col sm="10">
                                                                    <b-form-textarea 
                                                                        id="text-area-default"
                                                                        size="lg"
                                                                        placeholder="Sua resposta aqui..."
                                                                        v-model="form.content_coment_reply"></b-form-textarea>
                                                                </b-col>
                                                            </b-row>
                                                        </b-container>
                                                        
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <hr>
                                                    <b-button-group>
                                                        <b-button type="submit" variant="info" class="mr-1" size="sm">Responder</b-button>
                                                        <b-button type="reset" variant="warning" class="mr-1" size="sm">Limpar</b-button>
                                                    </b-button-group>
                                                </b-form>
                                            </b-modal>
                        <!-- Janela modal das Denuncias -->
                        <b-modal :id="denunciaModal.id" :title="denunciaModal.title" hide-footer>
                            <b-form @submit="storeDenuncia" method="post">
                                <label for="input-nome" description="Seu nome neste campo...">Seu Nome:</label>
                                <b-input 
                                    type="text" 
                                    id="input-nome" 
                                    class="mr-1" 
                                    size="sm" 
                                    v-model="form.nome_user_denuncia" 
                                    placeholder="Seu nome aqui..." 
                                    required>
                                </b-input>

                                <label for="input-email" description="Seum email neste campo...">Seu Email:</label>
                                <b-input 
                                    type="email" 
                                    id="input-email" 
                                    class="mr-1" 
                                    size="sm" 
                                    placeholder="Seu Email aqui..." 
                                    v-model="form.email_user_denuncia"
                                    required>
                                </b-input>

                                <label for="check-denucia">Denuncia:</label>
                                <b-form-group>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="injuria">Injuria ou Difamação</b-form-checkbox>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="racial">Racismo</b-form-checkbox>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="homofobia">Homofobia</b-form-checkbox>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="outro">outro</b-form-checkbox>
                                    

                                </b-form-group>

                                <b-button-group>
                                    <b-button type="submit" variant="info" class="mr-1" size="sm">Denunciar</b-button>
                                    <b-button type="reset" variant="warning" class="mr-1" size="sm">Limpar</b-button>
                                </b-button-group>
                            </b-form>
                        </b-modal>

                        <!-- Fim da modal de denuncias -->

                        <!-- Modal para remover resopstas -->
                            <b-modal :id="removeReplyModal.id" :title="removeReplyModal.title">
                                <b-form @submit="destroyReply" mehtod="post">
                                    Apenas o Autor da resposta está autorizado a remove-la...
                                    <label for="input-email" description="Seu email neste campo..."></label>
                                    <b-form-input 
                                        id="input-email" type="email" placeholder="Seu email aqui..."
                                        required v-model="form.email_user_coment_reply"></b-form-input>

                                        <b-button-group>
                                            <b-button type="submit" variant="info" class="mr-1" size="sm">Remover</b-button>
                                            <b-button type="reset" variant="warning" class="mr-1" size="sm">Limpar</b-button>
                                        </b-button-group>
                                </b-form>
                            </b-modal>
                        <!-- FIM DA MODAL -->

                        <!-- Janela modal das Denuncias respostas -->
                        <b-modal :id="denunciaReplyModal.id" :title="denunciaReplyModal.title" hide-footer>
                            <b-form @submit="storeDenunciaReply" method="post">
                                <label for="input-nome" description="Seu nome neste campo...">Seu Nome:</label>
                                <b-input 
                                    type="text" 
                                    id="input-nome" 
                                    class="mr-1" 
                                    size="sm" 
                                    v-model="form.nome_user_denuncia_reply" 
                                    placeholder="Seu nome aqui..." 
                                    required>
                                </b-input>

                                <label for="input-email" description="Seum email neste campo...">Seu Email:</label>
                                <b-input 
                                    type="email" 
                                    id="input-email" 
                                    class="mr-1" 
                                    size="sm" 
                                    placeholder="Seu Email aqui..." 
                                    v-model="form.email_user_denuncia_reply"
                                    required>
                                </b-input>

                                <label for="check-denucia">Denuncia:</label>
                                <b-form-group>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="injuria">Injuria ou Difamação</b-form-checkbox>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="racial">Racismo</b-form-checkbox>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="homofobia">Homofobia</b-form-checkbox>
                                    <b-form-checkbox v-model="selected" name="denuncia" value="outro">outro</b-form-checkbox>
                                    

                                </b-form-group>

                                <b-button-group>
                                    <b-button type="submit" variant="info" class="mr-1" size="sm">Denunciar</b-button>
                                    <b-button type="reset" variant="warning" class="mr-1" size="sm">Limpar</b-button>
                                </b-button-group>
                            </b-form>
                        </b-modal>

                        <!-- Fim da modal de denuncias respostas-->
                        </div>

                        <div>
                            <b-form @submit="store" method="post">
                                
                                <b-input-group>
                                    <b-form-group
                                        id="input-group-name"
                                        label="Seu nome:"
                                        label-for="input_nome"  
                                        description="Insira seu nome neste campo...">
                                        <b-form-input
                                            id="input_nome"
                                            placeholder="Seu nome aqui..."
                                            required 
                                            v-model="form.nome_user_coment"
                                            size="sm"
                                        >

                                        </b-form-input>
                                        
                                    </b-form-group>
                                    <b-form-group
                                        id="input-group-email"
                                        label="Seu Email:"
                                        label-for="input_email"
                                        description="Insira seu email neste campo"
                                    >

                                    <b-form-input
                                        id="input_email"
                                        placeholder="Seu email aqui..."
                                        required
                                        type="email"
                                        v-model="form.email_user_coment"
                                        size="sm"
                                    >

                                    </b-form-input>

                                    </b-form-group>
                                </b-input-group>
                                <b-form-group
                                    id="input-group-content"
                                    label="Comentario:"
                                    label-for="textarea_comentario"
                                    description="Insira seu comentario neste campo">

                                <vue-editor 
                                    v-model="form.content_coment" 
                                    id='textarea_comentario'
                                     name="content_comentario"
                                      aria-required
                                      placeholder="Insira seu comentario aqui..."
                                      >
                                    </vue-editor>

                                </b-form-group>
                                <div align="right">
                                <b-button-group>
                                    <b-button type="submit" variant="outline-info" class="mr-1" size="sm">
                                        <b-icon-chat-dots-fill></b-icon-chat-dots-fill>
                                            Comentar
                                    </b-button>
                                    <b-button type='reset' variant="outline-warning" class="mr-1" size="sm">
                                        <b-icon-trash></b-icon-trash>
                                            Limpar
                                    </b-button>
                                </b-button-group>
                                </div>
                            </b-form>
                            </div>
                        </div>
                    </template>
                </b-col>
                <b-col></b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    import {VueEditor} from 'vue2-editor';
    export default{
        props: ['noticia', 'img', 'comentarios', 'respostas'],
        components: {
            VueEditor,
        },
        data(){
            return{
                content_coment_reply: '',
                selected: [],
                limitComentarios: 3,
                form:{
                    nome_user_coment: '',
                    email_user_coment: '',
                    content_coment: '',
                    nome_user_coment_reply: '',
                    email_user_coment_reply: '',
                    content_coment_reply: '',
                    nome_user_denuncia: '',
                    email_user_denuncia: '',
                    nome_user_denuncia_reply: '',
                    email_user_denuncia_reply: '',
                   
                },

                //Janelas Modais
                replyModal: {
                    id: 'reply-modal',
                    title: '',
                    content: '',
                },
                removeModal: {
                    id: 'remove-modal',
                    title: '',
                    content: '',
                },
                removeReplyModal: {
                    id: "remove-reply-modal",
                    title: '',
                    content: '',
                },
                denunciaModal: {
                    id: 'denuncia-modal',
                    title: '',
                    content: '',
                },
                denunciaReplyModal:
                {
                    id: 'denuncia-reply-modal',
                    title: '',
                    content: '',
                }

            }
        },
        
        methods: {
            store(e)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.noticia.id;
                axios.post(`/comment/store/${id}`, {nome_user_coment: this.form.nome_user_coment, 
                                                    content_coment: this.form.content_coment, email_user_coment: this.form.email_user_coment})
                .then(function(response){
                    Vue.$toast.success('Comentario registrado com sucesso...', {
                        message: 'O seu comentário foi registrado com sucesso, muito obrigado...',
                        type: 'success',
                        position: 'top-right',
                    });
                    
                    location.reload();

                }).catch(function(error){
                    if(error.response.status == 401)
                    {
                        Vue.$toast.success('Comentario registrado com sucesso...', {
                        message: 'O seu comentário foi registrado com sucesso, muito obrigado...',
                        type: 'success',
                        position: 'top-right',
                        });
                    }

                    Vue.$toast.warning('Não foi possivel registrar seu comentário', {
                        message: 'Não pudemos registrar seu comentario, Erro:' + error + 'Entre em contato com suporte técnico...',
                        type: 'warning',
                        position: 'top-right',
                    });
                });
            },
            removeComent(n_coment, button)
            {
                this.removeModal.title = `Row index: ${n_coment.id}`
                this.removeModal.content = JSON.stringify(n_coment, null, 2)
                this.$root.$emit('bv::show::modal', this.removeModal.id, button)
                return this.n_coment = JSON.parse(this.removeModal.content)
            },
            destroyComent(e)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.n_coment.id;
                axios.post(`/comment/destroy/${id}`, {email_user_coment: this.form.email_user_coment})
                .then(function(response){
                    Vue.$toast.success('O comentário foi removido...', {
                        message: 'O comentário foi removido de nossa base de dados',
                        type: 'success',
                        position: 'top-right',
                    });

                    location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Não foi possivel remover o comentário, contate o suporte técnico...',{
                        message: 'Erro:' + this.erro + 'Contate o suporte técnico ....',
                        type: 'warning',
                        position: 'top-right',
                    });
                });
               
            },
            reply(noticia, n_coment, button){
                this.replyModal.title = `Row index ${n_coment.id}`
                this.replyModal.content = JSON.stringify(n_coment, null, 2)
                this.$root.$emit('bv::show::modal', this.replyModal.id, button)
                return this.n_coment = JSON.parse(this.replyModal.content)
            },
            storeReply(e)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.n_coment.id;
                var id_noticia = this.noticia.id;
                axios.post(`/reply/store/${id}`, {
                    nome_user_coment_reply: this.form.nome_user_coment_reply, email_user_coment_reply: this.form.email_user_coment_reply,
                    content_coment_reply: this.form.content_coment_reply
                })
                .then(function(response){
                    Vue.$toast.success('A Resposta foi registrada com sucesso',{
                        title: 'Sua resposta foi registrada',
                        message: 'Resposta registrada com sucesso, muito obrigado...',
                        type: 'success',
                        position: 'top-right',
                    });

                    location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Ocorreu um erro ao registra sua resposta', {
                        title: 'Erro: ' + this.error + 'Não foi possível registra sua resposta, contate o suporte técnico ou tente novamente mais tarde',
                        type: 'warning',
                        position: 'top-right',
                    });
                });

            },
            removeReply(c_r, button)
            {
                this.removeReplyModal.title = `Row index: ${c_r.id}`
                this.removeReplyModal.content = JSON.stringify(c_r, null, 2)
                this.$root.$emit('bv::show::modal', this.removeReplyModal.id, button)
                return this.c_r = JSON.parse(this.removeReplyModal.content);
            },
            destroyReply(e)
            {
                e.preventDefault();
                //let currentObj = this;
                var id = this.c_r.id;
                axios.post(`/reply/destroy/${id}`, {email_user_reply: this.form.email_user_coment_reply})
                .then(function(response){
                   Vue.$toast.success('Resposta removida', {
                       message: 'A resposta foi removida de nossos registros...',
                       type: 'success',
                       position: 'top-right',
                   })

                   location.reload();
                })
                .catch(function(error){
                   Vue.$toast.warning('Erro ao remover resposta', {
                       message: 'Erro: ' + this.error + 'Não foi possivel remover resposta, contate o suporte técnico',
                       type: 'warning',
                       position: 'top-right',
                   });
                });
                
            },
            denuncia(n_coment, button){
                this.denunciaModal.id = `Row index: ${n_coment.id}`
                this.denunciaModal.content = JSON.stringify(n_coment, null, 2)
                this.$root.$emit('bv::show::modal', this.denunciaModal.id, button)
                return this.n_coment = JSON.parse(this.denunciaModal.content);
            },
            storeDenuncia(e)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.n_coment.id;
                axios.post(`/denuncia/store/${id}`, {nome_user_denuncia: this.form.nome_user_denuncia, 
                        email_user_denuncia: this.form.email_user_denuncia, denuncia: this.selected})
                        .then(function(response){
                            Vue.$toast.success('Denuncia registrada...', {
                                message: 'Sua denuncia foi registrada, nossa equipe fará uma avaliação do comentário ....',
                                type: 'success',
                                postion: 'top-right',
                            });

                        }).catch(function(error){
                            Vue.$toast.warning('Error', {
                                messag: 'Erro ao registrar sua denuncia' + this.error + 'entre em contato com o suporte técnico...',
                                type: 'warning',
                                position: 'top-right',

                            });
                        });
            },
            denunciaReply(c_r, button)
            {
              this.denunciaReplyModal.id = `Row index: ${c_r.id}`
              this.denunciaReplyModal.content = JSON.stringify(c_r, null, 2)
              this.$root.$emit('bv::show::modal', this.denunciaReplyModal.id, button)
              return this.c_r = JSON.parse(this.denunciaReplyModal.content);  
            },
            storeDenunciaReply(e)
            {
                e.preventDefault();
                let currentObj = this;
                var id = this.c_r.id
                axios.post(`/denuncia_reply/store/${id}`, {email_user_denuncia_reply: this.form.email_user_denuncia_reply, denuncia_reply: this.selected})
                .then(function(response){
                    Vue.$toast.success('Denuncia registrada com sucesso...', {
                        message: 'sua denuncia foi registrada com sucesso, nossa equipe vai avaliar e tomar as providencias cabiveis',
                        type: 'success',
                        postion: 'top-right',
                    })
                    
                })
                .catch(function(error){
                   Vue.$toast.warning('Erro ao registrar denuncia', {
                       message: 'Erro: ' + this.error + 'erro ao registrar denuncia, entre em contato com o suporte técnico...',
                       type: 'warning',
                       position: 'top-right',
                   })
                });
            }
        },
        computed: {
            limitedComentarios(){
                return this.comentarios.slice(0, this.limitComentarios)
            }
        },
        mounted(){
            this.noticia = JSON.parse(this.noticia);
            this.img = JSON.parse(this.img);
            this.comentarios = JSON.parse(this.comentarios);
            this.respostas = JSON.parse(this.respostas);
        }
    }
</script>