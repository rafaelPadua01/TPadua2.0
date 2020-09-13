<template>

<div>
    <!-- Div Navbar --> 
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
    </div>
  
    <!-- Fim da NavBar -->
    <!-- Inicio da Página -->
        <div>
            <h1 align="center">Notícias</h1>
            <hr>
        </div>

        <div>
            
        </div>
     <div class="mt-3">
             <b-button-group>
                <b-button size="sm" class="mr-1" variant="secondary">
                    <b-icon-house-door-fill></b-icon-house-door-fill>
                   Página Incial
                </b-button>
                <b-button v-b-modal.modal-1  size="sm" class="mr-1" variant="info">
                    <b-icon-box-arrow-in-up-left></b-icon-box-arrow-in-up-left>
                     Nova Notícia
                </b-button>
                <b-button v-b-modal.modal-upload-imagem size="sm" class="mr-1" variant="info">
                    <b-icon-image></b-icon-image>
                    Upload de Imagem
                </b-button>
                <b-button v-b-modal.modal-galeria size="sm" class="mr-1" variant="info">
                    <b-icon-images></b-icon-images>
                    Criar Galeria de Imagem
                </b-button>
            </b-button-group>
    </div>
         <div>
             
            <b-modal id="modal-1" title="Formulário de Cadastro de Notícias"  modal-cancel 
                cancel-variant="secondary" hide-footer>
             
                <b-form @submit="create" method="post">
                <b-form-group
                id="input-group-1"
                label="Usuario:"
                label-for="input-1"
               >
                <b-form-select  id="input-1" v-model="form.id_user" required>
                    <template v-slot:first>
                        <b-form-select-option :value="null" disabled>{{auth_user.name}}</b-form-select-option>
                    </template>
                    <b-form-select-option
                       :value="auth_user.id"
                    >
                        {{auth_user.name}}
                    </b-form-select-option>
                </b-form-select>
                   
               </b-form-group>
                    <b-form-group
                        id="input-group-2"
                        label="Titulo da Notícia:"
                        label-for="input-2"
                        >
                    </b-form-group>
           
                <!-- Input do titulo -->
                <b-form-input
                    id="input-2"
                    v-model="form.titulo"
                    required 
                    placeholder="Titulo da notícia" 
                    name="titulo"
                    >
                </b-form-input>
                    
                <b-form-group
                    id="input-group-3"
                    label="categoria"
                    label-for="input-3"
                   
                >
                    <b-form-select  id="input-3" name="id_categoria" v-model="form.id_categoria" required>
                        <b-form-select-option
                            v-for="(categoria,key) in items_categoria" 
                            :key="key"
                            :value="categoria.id"
                        >
                            {{categoria.nome_categoria}}
                        </b-form-select-option>
                    </b-form-select>
                </b-form-group>
                <b-form-group
                    id="input-group-4"
                    label="Fonte da Noticia:"
                    label-for="input-4"
                    
                >
                </b-form-group>
                <b-form-input
                        id="input-4"
                        v-model="form.fonte"
                        placeholder="Fonte da Notícia"
                        name="fonte" 
                        required 
                >
                    

                </b-form-input>
                <b-form-group
                    id="input-group-5"
                    label="Conteudo da Notícia:"
                    label-for="input-5"
                    
                >
                </b-form-group>

                <vue-editor v-model="form.content" id="input-5" name="content" aria-required/>
                
               
               <b-form-group id="radio-group-1" label="Exibir Notícia como Destaque ?" label-for="radio-1" aria-required>
                   
                    <div>
                     <b-form-radio-group
                        id="radio-1"
                        :placeholder="item.destaque" 
                        :options="Destaqueoptions"
                        name="destaque"
                        v-model="form.destaque"
                        required>
                        </b-form-radio-group>
                    </div>
                  
               </b-form-group>
               
                <div align='center'>
                    <b-button-group>
                    <b-button type="reset" variant='warning'>
                        <b-icon-brush></b-icon-brush>
                            Limpar
                        </b-button>
                    <b-button type="submit" variant='success' @click="$bvModal.hide('modal-1')">
                        <b-icon-check-circle></b-icon-check-circle>
                            Salvar
                    </b-button>
                    </b-button-group>
                </div>
               
             </b-form>
        </b-modal>
    </div>
     <!-- Modal Form upload de imagens -->
     <div>
         <b-modal id="modal-upload-imagem" title="Upload de imagem" 
            modal-cancel cancel-variant="secondary" hide-footer>
            <b-form @submit="uploadImg" method="post" enctype="multipart/form-data">
                 <b-form-group
                id="input-group-select"
                label="Usuario:"
                label-for="input-select"
               
               >
                <b-form-select  id="input-select" v-model="form.id_user" required>
                    <template v-slot:first>
                        <b-form-select-option :value="null" disabled>{{auth_user.name}}</b-form-select-option>
                    </template>
                    <b-form-select-option
                       :value="auth_user.id"
                    >
                        {{auth_user.name}}
                    </b-form-select-option>
                </b-form-select>
                 </b-form-group>
                <b-form-group
                id="input-group-2"
                label="Selecione uma notícia"
                label-for="input-2"
                >
                    <b-form-select id="input-2" v-model="form.id">
                        <b-form-select-option
                        v-for="(item, index) in items" 
                        :key="index"
                        :value="item.id"
                        >
                            {{item.id}}.{{item.titulo}}
                        </b-form-select-option>
                    </b-form-select>
                    
                </b-form-group>
                <b-form-group
                id="input-group-2"
                label="Selecione o arquivo..."
                label-for="input-2"
                >

                <input type="file" id="nome_imagem" name="nome_imagem" ref="nome_imagem" v-on:change="onFileChange" :v-model="form.file">    
               
                <div class="mt-3">Selected file: {{ form.nome_imagem ? form.nome_imagem.name : '' }}</div>
                </b-form-group>
                <div align='center'>
                    <b-button-group>
                        <b-button variant="warning" type="reset">
                            <b-icon-brush></b-icon-brush>
                            limpar
                        </b-button>
                        <b-button variant="primary" type="submit">
                           <b-icon-upload></b-icon-upload>
                            upload
                        </b-button>
                        
                    </b-button-group>
                </div>
            </b-form>

         </b-modal>
     </div>
    <!-- Modal Form galeria de imagens -->
    <div>
        <b-modal id="modal-galeria" title="Galeria de Imagens"  modal-cancel 
                cancel-variant="secondary" hide-footer>
            <b-form @submit="uploadGaleria" method="post" enctype="multipart/form-data">
             <b-form-group
                id="input-group-1"
                label="Nome da Nova Galeria"
                label-for="input-1"
                >
                <input type="text" id="nome_galeria" name="nome_galeria"  placeholder="Nome da galeria" v-model="form.nome_galeria">
               
                <b-form-input
                id="input-1"
                v-model="form.nome_galeria"
                placeholder="nome_nova_galeria"
                required >

                </b-form-input>
                </b-form-group>
                <b-form-group
                    id="input-group-select"
                    label="Selecione uma notícia"
                    label-for="input-noticia">
                    <b-form-select id="input-noticia" v-model="form.id">
                        <b-form-select-option
                            v-for="(item, index) in items"
                            :key="index" 
                            :value="item.id"
                              
                        >
                            {{item.id}}.{{item.titulo}}
                        </b-form-select-option>
                    </b-form-select>
                </b-form-group>
                <b-form-group 
                    id = "input-file-group"
                    label="Selecione os Arquivos de imagem..."
                    label-for="input-file"
                    >
                    <input
                        id="input-file"
                        name="files[]"
                        type="file"
                        :v-model="form.files" 
                        v-on:change="handleFilesChange()"
                        ref="files"
                        multiple="multiple" 
                        :file-name-formatter="formatNames"
                         >
                </b-form-group>

                <div align='center'>
                    <b-button-group>
                        <b-button variant="warning" type="reset">
                            <b-icon-brush></b-icon-brush>
                                Limpar
                        </b-button>
                        <b-button variant="primary" type="submit">
                            <b-icon-upload></b-icon-upload>
                                upload
                        </b-button>
                    </b-button-group>
                </div>
            </b-form>
        </b-modal>
    </div>

        <div>
            <b-table striped hover bordered responsive="sm" caption-top
                :items="filtered"
                :categorias="categorias" 
                :fields="fields"
                :sort-by-sync="sortBy"
                :sort-desc.sync="sortDesc"
                :per-page="perPage"
                :current-page="currentPage"
                small
                primary-key="id"
               
             >
            <template v-slot:cell(acoes)="row">
                <b-button-group>
                    <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1" variant="info" >
                       <b-icon-reply></b-icon-reply>
                        Atualizar
                    </b-button>
           
                    <b-button size="sm" @click="remove(row.item, $event.target)" v-b-modal.modal-2 class="mr-1" variant="danger">
                       <b-icon-exclamation-circle-fill></b-icon-exclamation-circle-fill>
                        remover
                    </b-button>
                 </b-button-group>
                
            </template>
             <template v-slot:table-caption>
                 <div>
                  <small>Sorting by: <b>{{ sortBy }}</b>, Sort Direction: <b>{{ sortDesc ? 'Descending': 'Ascending'}}</b></small>
                 </div>
            </template>
                <template slot="top-row" slot-scope="{ fields }">
                    <td v-for='field in fields' :key="field.key">
                     <input v-model="filters[field.key]" v-if="field.key != 'acoes'" :placeholder="field.label">
                    </td>
                                
                </template>
                
            </b-table>
           <div>
          <!-- Modal que carrega o form de edição
                Fora do botão para não causar bug's -->
            <b-modal :id="infoModal.id" :title="infoModal.title" hide-footer>

            <!-- Inicia o formulário de edição -->
            <b-form @submit="update" method="put"> 
                <input type="hidden" :v-model="form.id" :value="item.id">

                <b-form-group
                id="input-group-1"
                label="Usuario:"
                label-for="input-1"
               
               >
                <b-form-select  id="input-1" v-model="form.id_user" required>
                    <template v-slot:first>
                        <b-form-select-option :value="null" disabled>{{auth_user.name}}</b-form-select-option>
                    </template>
                    <b-form-select-option
                       :value="auth_user.id"
                    >
                        {{auth_user.name}}
                    </b-form-select-option>
                </b-form-select>
                </b-form-group>  
                  <b-form-group
                    id="input-group-2"
                    label="Titulo da Notícia:"
                    label-for="input-1"
                    >
                    </b-form-group>
                
                <!-- Input do titulo -->
                <b-form-input
                    id="input-1"
                    v-model="form.titulo"
                    required 
                    :placeholder="item.titulo" 
                    >
                </b-form-input>
                
                
                <b-form-group
                    id="input-group-2"
                    label="categoria"
                    label-for="input-2"
                   
                >
                    <b-form-select  id="input-2" 
                        name="id_categoria"
                        v-model="form.id_categoria" 
                        
                        >
                        
                        <b-form-select-option
                            
                            v-for="(categoria,key) in items_categoria" 
                            :key="key"
                            :value="categoria.id"
                            :placeholder="categoria.nome_categoria"
                        >
                            {{categoria.id}}.{{categoria.nome_categoria}}
                        </b-form-select-option>
                    </b-form-select>
                </b-form-group>

                <b-form-group
                    id="input-group-3"
                    label="Fonte da Noticia:"
                    label-for="input-3"
                    
                >
                </b-form-group>
                    <b-form-input
                        id="input-3"
                        v-model="form.fonte"
                        :placeholder="item.fonte" 
                        required 
                    >
                    

                </b-form-input>
                <b-form-group
                    id="input-group-5"
                    label="Conteudo da Notícia:"
                    label-for="input-5"
                    
                >
                </b-form-group>

                <vue-editor v-model="form.content" id="input-5" name="content" aria-required/>{{item.content}}
                
               
               
                
               
                <b-form-group id="radio-group-1" label="Exibir Notícia como Destaque ?" label-for="radio-1" aria-required>
                   
                <div>
                    <div  v-if="item.destaque == 0">
                        Noticia em destaque: 
                        <strong>Não </strong>
                           
                    </div>
                    <div v-if="item.destaque == 1">
                        Noticia em destaque: 
                            <strong>
                                Sim 
                            </strong>
                          
                       
                    </div> 
                    <div>
                     <b-form-radio-group
                        id="radio-1"
                        :placeholder="item.destaque" 
                        :options="Destaqueoptions"
                        name="destaque"
                        v-model="form.destaque"
                        required>
                        </b-form-radio-group>
                    </div>
                </div>
                    
                  
            </b-form-group>
             
            <div align='center'>
                <b-button-group>
                    <b-button variant='warning' type="reset">
                        <b-icon-brush></b-icon-brush>
                            Limpar
                    </b-button>
                    <b-button type="submit" variant='success' @click="$bvModal.hide(infoModal.id)">
                        <b-icon-check-circle></b-icon-check-circle>
                         Salvar
                    </b-button>
                </b-button-group>
            </div>    
        </b-form>   
        </b-modal>
        </div>
           
            
          
            <!-- Modal que carrega o form de remoção
                Fora do botão para não causar bug's -->
            <b-modal :id="removeModal.id" :title="removeModal.title"  hide-footer>
               <b-form @submit="destroy">
                   <input type="hidden" :v-model="form.id" :value='item.id'>
                    <h2>Tem certeza que gostaria de remover essa notícia ?</h2>
                    <p>Ao remover essa notícia, ela será destruida de nosso banco de dados,
                        assim não podendo ser mais vista, acessada ou editada dentro de nosso 
                        sistema. 
                    </p>
                <b-button-group>
                    <b-button variant="success">Voltar</b-button> 
                    <b-button type="submit" variant="danger" @click="$bvModal.hide(removeModal.id)">
                        <b-icon-trash></b-icon-trash>
                            Remover
                    </b-button>    
                </b-button-group>
               </b-form>
               
                
            </b-modal>

             <div class="mt-3">
                        
                <b-pagination v-model="currentPage" pills align="center"
                    :total-rows="items.length" 
                    :per-page="perPage"
                >
                </b-pagination>
            </div>
         </div>
    </div>
</template>

<script>
 import {VueEditor} from "vue2-editor";
   
export default
    {
        props: ['noticias', 'categorias', 'value', 'user'],
        components:{
            VueEditor,
        },
        data() {
            return {
               
                form: {
                    id: '',
                    titulo: '',
                    id_categoria: '',
                    fonte: '',
                    content: '',
                    destaque: '',
                    id_user: '',
                    file: '',
                    nome_galeria: '',
                    files: '',
                },
                //cria uma variavel fitro com atributos
                filters: {
                    id: '',
                    issuedBy: '',
                    issuedTo: '',
                },
                //Cria os campos da tabela 
                fields: [
                {
                    key: 'titulo',
                    sortable: true
                },
                {
                    key: 'id_categoria',
                    sortable: true
                },
                {
                    key: 'created_at',
                    sortable: true
                },
                {
                    label:"Ações",
                    key: 'acoes',
                    sortable: false,
                    stickColumn: true,
                    colType:"button"
                }
                ],
               items:[],
               items_categoria: [],
               auth_user: [],
               item: [],
               totalRows: 1,
               currentPage: 1,
               perPage: 5,
               content: "<p placeholder='Noticia aqui...'></p>",

             //Define qual campo da tabela será usado para ordenação
                sortBy: "'titulo, data de criação'",
                sortDirection: 1,
                sortDesc: true,
                
            

                //Cria a modal update
                infoModal:{
                    id: 'info-modal',
                    title: '',
                    content: "",
                },
                removeModal:{
                    id: 'remove-modal',
                    title: '',
                    content: '',
                },
                galeriaModal:{
                    id: 'galeria-modal',
                    title: '',
                    content: '',
                },
                Destaqueoptions: [
                    {text: 'Sim', value: '1'},
                    {text: 'Não', value: '0'}
                    
                ]
            }
        },
        
         computed: {
             //cria o metodo que filtra por palavras
                filtered() {
                    const filtered = this.items.filter(item=>{
                        return Object.keys(this.filters).every(key => 
                            String(item[key]).includes(this.filters[key]))
                    })
                    //retorna o valor da busca 
                    return filtered.length > 0 && filtered.key != 'acoes' ? filtered : [{
                        id: '',
                        issuedBy: '',
                        issuedTo: '',
                    }]
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
            info(item, index, button){
                this.infoModal.title = `Row Index: ${index}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
                return this.item = JSON.parse(this.infoModal.content)

            },
            remove(item, index, button){
                this.removeModal.title = `"Row Index: ${index}`
                this.removeModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.removeModal.id, button)
                return this.item = JSON.parse(this.removeModal.content)
            },
            galeria(items, index, button){
                this.galeriaModal.title= `Row Index: ${index}`
                this.galeriaModal.content = JSON.stringfy(item, null, 2)
                this.$root.$emit('bv::show::modal', this.galeriaModal.id, button)
                return this.item = JSON.parse(this.galeriaModal.content)
            },
            resetInfoModal()
            {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            
            create(e)
            {
                e.preventDefault();
                let currentObj = this;
                axios.post('/teste/create',{id_user: this.form.id_user, titulo: this.form.titulo,
                    id_categoria: this.form.id_categoria, fonte: this.form.fonte,
                        content: this.form.content, destaque: this.form.destaque})
                .then(function(response) {
                  
                 // window.confirm('Nova Notícia cadastrada');
                  if(response)
                  {
                       Vue.$toast.success('Notícia Cadastrada',{
                           message: 'Uma nova notícia foi cadastrada.',
                           type: 'success',
                           position: 'top-right',

                       });
                        location.reload();
                    //return console.log(response.data);
                  }
                 
                })
                .catch(function(error)  {
                    Vue.$toast.warning('Algo deu errado', {
                        message: 'Algo errado aconteceu, tente novamente em alguns segundos',
                        type: 'erro',
                        position: 'top-right'
                    });
                })

                Vue.$toast.clear();
            },
            update(e,item)
            {
                e.preventDefault();
                let currentObj = this;
                let id = this.item.id;
                
                axios.put(`/teste/update/${id}`, 
                    {
                        id: this.form.id, titulo: this.form.titulo, id_categoria: this.form.id_categoria,
                        fonte: this.form.fonte, content: this.form.content,
                        destaque: this.form.destaque
                    })
                .then(function(response){
                   //console.log(response.data);
                    Vue.$toast.success('Notícia Atualizada',{
                           message: 'A notícia foi atualizada com sucesso.',
                           type: 'success',
                           position: 'top-right',

                     });
                     location.reload();
                    
                })
                .catch(function (error){
                   // console.log(error);
                    Vue.$toast.warning('Algo deu errado', {
                        message: 'erro = ${error}',
                        type: 'erro',
                        position: 'top-right'
                    });
                    
                });
            },
            /*Função destroy representa a função delete nesta parte do projeto */
            destroy(e,item)
            {
                e.preventDefault();
                let currentObj = this;
                let id = this.item.id;
                axios.get(`/teste/destroy/${id}`, {id: this.form.id})
                    .then(function(response){
                         Vue.$toast.success('Notícia removida',{
                           message: 'A notícia foi removida de nossa base de dados.',
                           type: 'success',
                           position: 'top-right',

                     });
                        //console.log(response)
                        location.reload();
                    })
                    .catch(function(error){
                        Vue.$toast.warning('Algo deu errado', {
                        message: 'erro = ${error}',
                        type: 'erro',
                        position: 'top-right'
                    });
                       //console.log(error)
                    });
               // console.log(this.id);


            },
            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            uploadImg(e){
                e.preventDefault();
                let currentObj = this;
                let id = this.form.id;
                
                const config = {
                    headers: {
                        'content-type' : 'multipart/form-data'
                    }
                }

                let formData = new FormData();
                formData.append('file', this.file);
               
                axios.post(`/teste/uploadImg/${id}`, formData, config,{
                        id: this.form.id, file: this.form.file,
                        id_user: this.form.id_user
                })
                    .then(function(response){
                          Vue.$toast.success('Notícia removida',{
                           message: 'Upload de imagem completo...',
                           type: 'success',
                           position: 'top-right',

                     });
                        //console.log(response)
                        location.reload();
                    })
                    .catch(function(error){
                        Vue.$toast.warning('Algo deu errado', {
                        message: 'erro = ${error}',
                        type: 'erro',
                        position: 'top-right'
                    });
                       //console.log(error)
                    });
                
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            formatNames(files){
                if(files.length === 1)
                {
                    return files[0].name
                }
                else
                {
                    return `Arquivos selecionados: (${files.length})`
                }
            },
            uploadGaleria(e){
                e.preventDefault();
                let currentObj = this;
                let id = this.form.id;
                const config = {
                    headers: {
                        'content-type' : 'multipart/form-data'
                    }
                }

                let formData = new FormData();
                //Loop que percorre o arquivos de imagens
                // cria uma let file, e atribui ao objeto formData 
                for(var i = 0; i < this.files.length; i++)
                    {
                        let file = this.files[i];
                        formData.append('files['+ i + ']', file);
                    }

             
                axios.post(`/teste/galeriaImg/${id}`, formData, config, {
                    id: this.form.id, file: this.form.files, nome_galeria: this.form.nome_galeria
                })
                .then(function(response){
                    Vue.$toast.success('Notícia removida',{
                           message: 'Upload de imagem completo...',
                           type: 'success',
                           position: 'top-right',

                     });
                        //console.log(response)
                        //location.reload();
                })
                .catch(function(error){
                    Vue.$toast.warning('Algo deu errado', {
                    message: 'Erro: ${error}, Contate o suporte técnico e informe o erro...',
                    type: 'warning',
                    position: 'top-right'
                    });
                       //console.log(error)
                });
            },
            handleFilesChange(){
                this.files = this.$refs.files.files;
            },

        },
        
         mounted() {
           
            this.items = JSON.parse(this.noticias);
            this.items_categoria = JSON.parse(this.categorias);
            this.auth_user = JSON.parse(this.user);
           
    }
        
}
</script>