<template>
  <div class="q-pa-md">
    <q-btn  label="Crear Producto" color="positive" @click="alert = true" icon="add_circle" class="q-mb-xs" />
    <q-dialog v-model="alert">
      <q-card>
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6">Crear</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
        >
          <q-tab name="Datos" label="Datos" />
          <q-tab name="Descripcion" label="Descripcion" />
          <q-tab name="Ingrediente" label="Ingrediente" />
        </q-tabs>

          <q-form
            @submit="onSubmit"
            @reset="onReset"
            class="q-gutter-md"
          >
        <q-tab-panels v-model="tab" animated>
          <q-tab-panel name="Datos">
            <q-input
              filled
              v-model="dato.nombre"
              type="text"
              label="Nombre"
              hint="Ingresar nombre"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'Por favor ingresa datos']"
            />
            <q-input
              filled
              v-model="dato.descripcion"
              type="text"
              label="Descripcion"
              hint="Ingresar descripcion"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'Por favor ingresa datos']"
            />
            <q-input
              filled
              v-model="dato.precio"
              label="Precio"
              type="number"
              hint="Ingresar precio"
              lazy-rules
              :rules="[ val => val>0 && val < 500 || 'Por favor Valor']"
            />
            <q-select
              v-model="dato.tipo"
              label="Tipo"
              :options="['PRODUCTO','COMBO']"
              emit-value
            />
            <q-select
              v-model="dato.rubro_id"
              label="Rubro"
              :options="options"
              emit-value
            />


            <q-uploader
              style="max-width: 300px"
              label="Main Image"
              :factory="uploadFile"
              max-files="1"
              accept=".jpg,.png, image/*"
            />
            </q-tab-panel>
            <q-tab-panel name="Descripcion">
                <q-table
                title="Detalle"
                :columns="detalle2"
                :rows="dato.detalle"

                >
                <template v-slot:body="props">
                <q-tr :props="props">
                    <td key='index' :props="props">
                    {{props.pageIndex+1}}
                    </td>
                    <td key="nombre" :props="props">
                        <input type="text" v-model="props.row.nombre"
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'Por favor ingresa datos']">
                    </td>
                <q-td key="opcion" :props="props">
                    <q-btn dense round flat color="green"  @click="mas" icon="add"></q-btn>
                    <q-btn dense round flat color="red" @click="menos(props.pageIndex)" icon="remove"></q-btn>
                </q-td>
                </q-tr>
            </template>


                </q-table>
            </q-tab-panel>


            <q-tab-panel name="Ingrediente">
              <div class="row">
                <q-select
                  v-model="ingred.ingrediente"
                  label="Ingrediente"
                  :options="opingrediente"
                  style="width:100px"
                />
                <q-input
                label="Cantidad"
                v-model="ingred.cantidad"
                type="number"
                 min=1
                />
                <q-btn dense round flat color="green"  @click="agregaring" icon="add" label="Agregar"></q-btn>
                </div>

               <q-table
                title="Ingredientes"
                :columns="columns3"
                :rows="dato.ingrediente"
                row-key="ingrediente"
                >
                <template v-slot:body="props">
                <q-tr :props="props">
                    <td key='index' :props="props">
                    {{props.pageIndex+1}}
                    </td>
                    <td key="ingrediente" :props="props">
                    {{props.row.ingrediente}}
                    </td>
                    <td key="cantidad" :props="props">
                    {{props.row.cantidad}}
                    </td>
                <q-td key="opcion" :props="props">
                    <q-btn dense round flat color="red" @click="quitar(props.pageIndex)" icon="remove"></q-btn>
                </q-td>
                </q-tr>
            </template>


                </q-table>
            <div>
              <q-btn label="Crear" type="submit" color="positive" icon="add_circle"/>
                <q-btn  label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
            </q-tab-panel>
            </q-tab-panels>
          </q-form>
        </q-card-section>


      </q-card>
    </q-dialog>
    <q-table
      title="Productos"
      :rows="data"
      :columns="columns"
      row-key="name"
    >
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="nombre" :props="props">
            {{ props.row.nombre }}
          </q-td>
          <q-td key="imagen" :props="props"  width='200'>
              <img :src="url+'/../imagenes/'+props.row.imagen"  width="50" >
          </q-td>
          <q-td key="stock" :props="props">
            {{ props.row.stock }}
          </q-td>
          <q-td key="precio" :props="props">
            {{ props.row.precio }}
          </q-td>
          <q-td key="rubro" :props="props">
            <div class="text-h6">{{ props.row.rubro.nombre }}</div>
          </q-td>
          <q-td key="agencia_id" :props="props">
            <div class="text-h6"> <q-select @update:model-value="cambio($event,props.row)"  outlined label="Agencia" v-model="props.row.agencia" option-value="id" :options="sucursales"   option-label="nombre"/> </div>
          </q-td>
          <q-td key="opcion" :props="props">
<!--            <q-btn dense round flat color="green" @click="addRow(props)" icon="add"></q-btn>-->
<!--            <q-btn dense round flat color="red" @click="substractRow(props)" icon="remove"></q-btn>-->
<!--            <q-btn dense round flat color="yellow" @click="verRow(props)" icon="list"></q-btn>-->
            <q-btn dense round flat color="yellow" @click="editRow(props)" icon="edit"></q-btn>
            <q-btn dense round flat color="ingo" @click="editImg(props)" icon="photo"></q-btn>
            <q-btn dense round flat color="red" @click="deleteRow(props)" icon="delete"></q-btn>
          </q-td>
        </q-tr>
      </template>

    </q-table>
    <q-dialog v-model="dialog_mod">
      <q-card>
        <q-card-section class="bg-amber-14 text-white">
          <div class="text-h6">Modificar</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">

        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
        >
          <q-tab name="Datos" label="Datos" />
          <q-tab name="Descripcion" label="Descripcion" />
          <q-tab name="Ingrediente" label="Ingrediente" />
          <q-tab name="combo" label="Combo" />
        </q-tabs>


        <q-tab-panels v-model="tab" animated>
          <q-tab-panel name="Datos">
            <q-form
            @submit="onMod"
            class="q-gutter-md"
          >
            <q-input
              filled
              v-model="dato2.nombre"
              type="text"
              label="Nombre"
              hint="Ingresar nombre"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'Por favor ingresa datos']"
            />
            <q-input
              filled
              v-model="dato2.descripcion"
              type="text"
              label="Descripcion"
              hint="Ingresar descripcion"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'Por favor ingresa datos']"
            />
            <q-input
              filled
              v-model="dato2.precio"
              label="Precio"
              type="number"
              hint="Ingresar precio"
              lazy-rules
              :rules="[ val => val>0 && val < 500 || 'Por favor Valor']"
            />
            <q-select
              v-model="dato2.tipo"
              label="Tipo"
              :options="['PRODUCTO','COMBO']"
              emit-value
            />
            <q-select
              v-model="dato2.rubro_id"
              label="Rubro"
              :options="options"
              emit-value
            />

            <q-select
              v-model="dato2.agencia_id"
              label="Sucursal"
              :options="sucursal"
              emit-value
            />
              <q-btn label="Modificar" type="submit" color="positive" icon="add_circle"/>
            </q-form>
             </q-tab-panel>
            <q-tab-panel name="Descripcion">
             <q-table
                title="Detalle"
                :columns="detalle2"
                :rows="dato2.detalle"
                >
                <template v-slot:body="props">
                <q-tr :props="props">
                    <td key='index' :props="props">
                    {{props.pageIndex+1}}
                    </td>
                    <td key="nombre" :props="props">
                        <input type="text" v-model="props.row.nombre"
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'Por favor ingresa datos']">
                    </td>
                <q-td key="opcion" :props="props">
                    <q-btn dense round flat color="green"  @click="mas2" icon="add"></q-btn>
                    <q-btn dense round flat color="red" @click="menos2(props.pageIndex)" icon="remove"></q-btn>
                </q-td>
                </q-tr>
            </template>
                </q-table>
              <q-btn label="Modificar" type="button" color="positive" icon="add_circle" @click="onModdetalle"/>
            </q-tab-panel>
          <q-tab-panel name="combo">
            <div class="row">
              <div class="col-4">
                <q-select
                  v-model="ingred2.producto_id2"
                  label="Seleccionar producto"
                  :options="data"
                  option-label="nombre"
                />
              </div>
              <div class="col-4">
                <q-select
                  label="Cantidad"
                  v-model="ingred2.tipo"
                  :options="['JUGO','AGREGADO']"
                />
              </div>
              <div class="col-4 flex flex-center">
                <q-btn dense round flat color="green"  @click="agregarcombo" icon="add" label="Agregar"></q-btn>
              </div>

            </div>

            <q-table
              title="Ingredientes"
              :columns="columns4"
              :rows="dato2.combo"
              row-key="ingrediente"
            >
              <template v-slot:body="props">
                <q-tr :props="props">
                  <td key='index' :props="props">
                    {{props.pageIndex+1}}
                  </td>
                  <td key="nombre" :props="props">
                    {{props.row.nombre}}
                  </td>
<!--                  <td key="cantidad" :props="props">-->
<!--                    {{props.row.cantidad}}-->
<!--                  </td>-->
                  <q-td key="opcion" :props="props">
                    <q-btn dense round flat color="red" @click="quitarcombo(props.row.id)" icon="remove"></q-btn>
                  </q-td>
                </q-tr>
              </template>
            </q-table>
            <div>
              <q-btn label="Modificar" type="button" color="positive" icon="add_circle" @click="onModingrediente"/>
            </div>
          </q-tab-panel>

            <q-tab-panel name="Ingrediente">
              <div class="row">
                <q-select
                  v-model="ingred2.ingrediente"
                  label="Ingrediente"
                  :options="opingrediente"
                  style="width:100px"
                />
                <q-input
                label="Cantidad"
                v-model="ingred2.cantidad"
                type="number"
                 min=1
                />
                <q-btn dense round flat color="green"  @click="agregaring2" icon="add" label="Agregar"></q-btn>
                </div>

               <q-table
                title="Ingredientes"
                :columns="columns3"
                :rows="dato2.ingrediente"
                row-key="ingrediente"
                >
                <template v-slot:body="props">
                <q-tr :props="props">
                    <td key='index' :props="props">
                    {{props.pageIndex+1}}
                    </td>
                    <td key="ingrediente" :props="props">
                    {{props.row.ingrediente}}
                    </td>
                    <td key="cantidad" :props="props">
                    {{props.row.cantidad}}
                    </td>
                <q-td key="opcion" :props="props">
                    <q-btn dense round flat color="red" @click="quitar2(props.pageIndex)" icon="remove"></q-btn>
                </q-td>
                </q-tr>
            </template>


                </q-table>
            <div>
              <q-btn label="Modificar" type="button" color="positive" icon="add_circle" @click="onModingrediente"/>
            </div>
            </q-tab-panel>
            </q-tab-panels>

            <div>
            </div>
        </q-card-section>


      </q-card>
    </q-dialog>

    <q-dialog v-model="dialog_img">
      <q-card>
        <q-card-section class="bg-amber-14 text-white">
          <div class="text-h6">Modificar imagen</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form
            @submit="onMod"
            class="q-gutter-md"
          >
            <q-uploader
              style="max-width: 300px"
              label="Main Image"
              :factory="uploadFile2"
              max-files="1"
              accept=".jpg,.png, image/*"
            />
            <div>
              <q-btn label="Modificar" type="submit" color="positive" icon="add_circle"/>
              <q-btn  label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>

          </q-form>
        </q-card-section>


      </q-card>
    </q-dialog>

<q-dialog v-model="dialog_add">
      <q-card>
        <q-card-section class="bg-amber-14 text-white">
          <div class="text-h6">Agregar Producto</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form
            @submit="onAdd"
            class="q-gutter-md"
          >
            <q-input
              filled
              v-model="dato2.nombre"
              type="text"
              label="Nombre"
              readonly
            />

            <q-input
              filled
              v-model="agregar"
              label="Cantidad a agregar"
              type="number"
              lazy-rules
              :rules="[ val => val>0 && val < 500 || 'Por favor Valor']"
            />

             <div>
              <q-btn label="Agregar" type="submit" color="positive" icon="add_circle"/>
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>


<q-dialog v-model="dialog_sub">
      <q-card>
        <q-card-section class="bg-amber-14 text-white">
          <div class="text-h6">Corregir cantidad Producto</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form
            @submit="onSub"
            class="q-gutter-md"
          >
            <q-input
              filled
              v-model="dato2.nombre"
              type="text"
              label="Nombre"
              readonly
            />

            <q-input
              filled
              v-model="disminuir"
              label="Cantidad a Retirar"
              type="number"
              lazy-rules
              :rules="[ val => val>0 && val < 500 || 'Por favor Valor']"
            />

             <div>
              <q-btn label="Corregir" type="submit" color="red" icon="remove_circle"/>
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>

<q-dialog v-model="dialog_ver">
      <q-card>
        <q-card-section class="bg-amber-14 text-white">
          <div class="text-h6">Log Cambios Cantidad</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
            <q-input
              filled
              v-model="dato2.nombre"
              type="text"
              label="Nombre"
              readonly
            />
      <q-table
      title="Log Cantidad Productos"
      :data="prod2"
      :columns="columns2" />


        </q-card-section>
      </q-card>
    </q-dialog>


    <q-dialog v-model="dialog_del" >
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="clear" color="red" text-color="white" />
          <span class="q-ml-sm">Seguro de eliminar Registro.</span>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Eliminar" color="deep-orange" @click="onDel"/>
          <q-btn flat label="Cancelar" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>

    <q-form @submit.prevent="historialplato">
      <div class="row">
        <div class="col-4 q-pa-md">
          <q-input label="Fecha inicio" v-model="fecha.inicio"/>
        </div>
        <div class="col-4 q-pa-md">
          <q-input label="Fecha fin" v-model="fecha.fin"/>
        </div>
        <div class="col-4 q-pa-md">
          <q-btn type="submit" label="Imprimir" icon="send" class="full-width full-height" color="secondary"/>
        </div>
      </div>
    </q-form>

  </div>

</template>

<script>
import {date} from "quasar";

export default {
  data () {
    return {
      url:process.env.API,
      fecha:{
        inicio:date.formatDate(Date.now(),'YYYY-MM-DD'),
        fin:date.formatDate(Date.now(),'YYYY-MM-DD'),
      },
      alert: false,
      dialog_mod:false,
      dialog_img:false,
      dialog_del:false,
      dialog_add:false,
      dialog_sub:false,
      dialog_ver:false,
      tab:'Datos',
      name: null,
      age: null,
      accept: false,
      dato:{},
      dato2:{},
      modprod:{},
      options:[],
      opingrediente:[],
      props:[],
      agregar:0,
      disminuir:0,
      ingrediente_id:'',
      cantidad:0,
      ingrediente:'',
      ingred:{cantidad:1},
      ingred2:{cantidad:1},
      detalle2 : [
            {
            name: 'index',
            label: '#',
            field: 'index'
        },
        {
            name: 'detalle',
            required: true,
            label: 'Detalle',
            align: 'left',
            field: 'nombre',
        },
        {
            name: 'opcion',
            required: true,
            label: 'opcion',
            align: 'center',
            field: 'action',
        }
        ],
      columns: [
        {
          name: 'nombre',
          required: true,
          label: 'Nombre',
          align: 'left',
          field: row => row.nombre,
          // format: val => `${val}`,
          sortable: true
        },
        { name: 'imagen', align: 'center', label: 'Imagen', field: 'imagen', sortable: true },
        { name: 'stock', align: 'right', label: 'Stock', field: 'stock', sortable: true },
        { name: 'precio', align: 'right', label: 'Precio', field: 'precio', sortable: true },
        { name: 'rubro', align: 'center', label: 'Rubro', field: 'rubro', sortable: true },
        { name: 'agencia_id', align: 'center', label: 'Agencia', field: 'agencia_id', sortable: true },
        { name: 'opcion', label: 'Opcion', field:'action',  sortable: false },

      ],
      columns2: [
        {
          name: 'cantidad',
          required: true,
          label: 'cantidad',
          align: 'left',
          field: row => row.stock,
          // format: val => `${val}`,
          sortable: true
        },
        { name: 'detalle', align: 'center', label: 'detalle', field: 'detalle', sortable: true },
        { name: 'fecha', align: 'right', label: 'fecha', field: 'fecha', sortable: true },
        { name: 'nombre', align: 'right', label: 'nombre', field: 'name', sortable: true },

      ],
      columns3:[

            {
            name: 'index',
            label: '#',
            field: 'index'
        },
        {
            name: 'ingrediente',
            label: 'Ingrediente',
            align: 'center',
            required: true,
            field: 'ingrediente',
        },
        {
            name: 'cantidad',
            label: 'Cantidad',
            required: true,
            align: 'center',
            field: 'cantidad',
        },
        {
            name: 'opcion',
            required: true,
            label: 'opcion',
            align: 'center',
            field: 'action',
        }

      ],
      columns4:[

        {
          name: 'index',
          label: '#',
          field: 'index'
        },
        {
          name: 'nombre',
          label: 'Nombre',
          align: 'center',
          required: true,
          field: 'nombre',
        },
        {
          name: 'opcion',
          required: true,
          label: 'opcion',
          align: 'center',
          field: 'action',
        }

      ],
      data: [
      ],
      prod2: [
      ],
      sucursal:[],
      sucursales:[]
    }
  },
  created() {
    this.misdatos();
    this.misrubros();
    this.misingredientes();
    this.misagencias();
    this.dato={detalle:[{nombre:''}],ingrediente:[]};
  },
  methods:{
    agregaring(){
      console.log(this.ingred.ingrediente['value']);
      this.ingrediente_id=this.ingred.ingrediente['value'];
      this.ingrediente=this.ingred.ingrediente['label'];
      this.cantidad=this.ingred.cantidad;
      this.dato.ingrediente.push({ingrediente_id:this.ingrediente_id,ingrediente:this.ingrediente,cantidad:this.cantidad});
    },
    agregarcombo(){
      // console.log(this.ingred2)
      // console.log(this.dato2)
      let data={
        producto_id:this.dato2.id,
        producto_id2:this.ingred2.producto_id2.id,
        tipo:this.ingred2.tipo,
      }
      // console.log(data)
      this.$axios.post(process.env.API + '/combo', data).then(res=>{
        // console.log(res.data)
        this.buscarmicombo()
      })
    },
    quitarcombo(id){
      this.$axios.delete(process.env.API + '/combo/'+id).then(res=>{
        // console.log(res.data)
        this.buscarmicombo()
      })
    },
    agregaring2(){
      console.log(this.ingred2.ingrediente['value']);
      this.ingrediente_id=this.ingred2.ingrediente['value'];
      this.ingrediente=this.ingred2.ingrediente['label'];
      this.cantidad=this.ingred2.cantidad;
      this.dato2.ingrediente.push({ingrediente_id:this.ingrediente_id,ingrediente:this.ingrediente,cantidad:this.cantidad});
    },
             mas(){
                this.dato.detalle.push({nombre:''});
            },
            menos(index){
                if(index > 0)
                this.dato.detalle.splice(index, 1);
            },
           mas2(){
                this.dato2.detalle.push({nombre:''});
            },
            menos2(index){
                if(index > 0)
                this.dato2.detalle.splice(index, 1);
            },
            quitar(index){
                this.dato.ingrediente.splice(index, 1);
            },
            quitar2(index){
                this.dato2.ingrediente.splice(index, 1);
            },
    uploadFile(files) {
      this.file_path = files[0]
      const fileData = new FormData()
      fileData.append('imagen', this.file_path)
      // console.log(fileData);
      //Replace http://localhost:8000 with your API URL
      const uploadFile = this.$axios.post(process.env.API+'/upload', fileData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then((response) => {
        // console.log(response.data);
        this.dato.imagen=response.data;
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Imagen subido correctamente!'
        });
      });
    },
    uploadFile2(files) {
      this.file_path = files[0]
      const fileData = new FormData()
      fileData.append('imagen', this.file_path)
      const uploadFile = this.$axios.post(process.env.API+'/upload', fileData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then((response) => {
        this.dato2.imagen=response.data;
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Imagen subido correctamente!'
        });
      });
    },
    onRejected (rejectedEntries) {
      this.$q.notify({
        type: 'negative',
        message: `${rejectedEntries.length} file(s) did not pass validation constraints`
      })
    },
    historialplato(){
      this.$axios.post(process.env.API+'/logproducto',this.fecha).then(res=>{
        let myWindow = window.open("", "Imprimir", "width=200,height=100");
        myWindow.document.write(res.data);
        myWindow.document.close();
        myWindow.focus();
        setTimeout(function(){
          myWindow.print();
          myWindow.close();
        },500);
      })
    },
    misdatos(){
      this.$q.loading.show();
      this.$axios.get(process.env.API+'/producto').then(res=>{
        // res.data.forEach(r=>{
        //   let a=r.agencia
        //   a.producto_id=r.id
        //   console.log(a)
        //   r.agencia=a
        //   console.log(r)
        //   this.data.push(r)
        // })

        this.data=res.data
        this.$q.loading.hide();
      })
    },
    misagencias(){
      this.sucursal=[];
      this.$axios.get(process.env.API+'/agencia').then(res=>{
        // console.log(res.data);
        this.sucursales=res.data
        res.data.forEach(row=>{
          this.sucursal.push({label:row.nombre,value:row.id});
        })
      })
    },
    misrubros(){
        this.options=[];
        this.$axios.get(process.env.API+'/rubro').then(res=>{
            res.data.forEach(row => {
                this.options.push({label:row.nombre,value:row.id});
            });
        })
    },
    misingredientes(){
        this.options=[];
        this.$axios.get(process.env.API+'/ingrediente').then(res=>{
          // console.log(res.data);
            res.data.forEach(row => {
                this.opingrediente.push({label:row.nombre,value:row.id});
            });
        })
    },
    cambio(agencia,producto){
      // console.log(value.nombre)
      // console.log(producto)
      let agencia_id=agencia.id
      let id=producto.id
      // console.log(agencia_id+' '+id)
      this.$axios.put(process.env.API+'/producto/'+id,{agencia_id})
    },
    editRow(producto){
        // console.log(producto.row);
        this.dato2= producto.row;
        // console.log(this.dato2);
        if(producto.row.incluyes.length==0)
        this.dato2.detalle=[{nombre:''}];
        else
        this.dato2.detalle=producto.row.incluyes;
        if(producto.row.ingredientes.length==0)
        this.dato2.ingrediente=[];
        else{
          this.dato2.ingrediente=[];
        producto.row.ingredientes.forEach(element => {
        this.dato2.ingrediente.push({cantidad:element.pivot.cantidad,ingrediente:element.nombre,ingrediente_id:element.pivot.ingrediente_id});

        })}
        // console.log(this.dato2);
      this.buscarmicombo()
        this.dialog_mod=true;
    },
    buscarmicombo(){
      this.dato2.combo=[]
      this.$axios.get(process.env.API+'/combo/'+this.dato2.id).then(res=>{
        // console.log(res.data)
        res.data.forEach(r=>{
          this.dato2.combo.push(r)
        })
        // console.log(this.dato2);
      })
    },
    editImg(producto){
      // console.log(producto.row);
      this.dato2= producto.row;
      this.dialog_img=true;
    },
    deleteRow(producto){
        // console.log(producto.row);
        this.dato2= producto.row;
        this.dialog_del=true;
    },

    addRow(producto){
        // console.log(producto.row);
        this.dato2= producto.row;
        this.dialog_add=true;
    },
    substractRow(producto){
        this.dato2= producto.row;
        this.dialog_sub=true;
    },
    verRow(producto){
        this.dato2= producto.row;
        this.$axios.post(process.env.API+'/verdatos',this.dato2).then(res=>{
          console.log(res.data);
          this.prod2=res.data;
        });
        this.dialog_ver=true;
    },
    onSubmit () {
      this.$q.loading.show();
        console.log(this.dato.detalle);
      if (this.dato.detalle[0]=={nombre:''})this.dato.detalle=[];
      this.$axios.post(process.env.API+'/producto', this.dato).then(res=>{
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Creado correctamente'
        });
        this.alert=false;
        this.misdatos();
      })


    },
    onMod(){
        this.$q.loading.show();
        this.$axios.put(process.env.API+'/producto/'+this.dato2.id,this.dato2).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Modificado correctamente'
        });
        this.dialog_mod=false;
          this.dialog_img=false;
        this.misdatos();})
    },
    onModdetalle(){
        this.$q.loading.show();
        this.$axios.post(process.env.API+'/upincluye',this.dato2).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Modificado correctamente'
        });
        this.dialog_mod=false;
          this.dialog_img=false;
        this.misdatos();})
    },
        onModingrediente(){
        this.$q.loading.show();
        this.$axios.post(process.env.API+'/upingrediente',this.dato2).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Modificado correctamente'
        });
        this.dialog_mod=false;
          this.dialog_img=false;
        this.misdatos();})
    },

        onModimg(){
        this.$q.loading.show();
        this.$axios.put(process.env.API+'/updateimg/'+this.dato2.id,this.dato2).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Modificado correctamente'
        });
        this.dialog_mod=false;
          this.dialog_img=false;
        this.misdatos();})
    },
    onDel(){
        this.$q.loading.show();
        this.$axios.delete(process.env.API+'/producto/'+this.dato2.id).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Eliminado correctamente'
        });
        this.dialog_del=false;
        this.misdatos();})
    },
    onAdd(){
        this.$q.loading.show();
        this.modprod={id:this.dato2.id,stock:this.agregar}
        this.$axios.post(process.env.API+'/productadd',this.modprod).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Agregado correctamente'
        });
        this.dialog_add=false;
        this.agregar=0;
        this.misdatos();})
    },


onSub(){
        this.$q.loading.show();
        this.modprod={id:this.dato2.id,stock:this.disminuir};
        this.$axios.post(process.env.API+'/productsub',this.modprod).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Agregado correctamente'
        });
        this.dialog_sub=false;
        this.disminuir=0;
        this.misdatos();})
    },

    onReset () {
      this.dato.nombre = null;
      this.dato.precio = 0.00;
      this.dato.rubro_id=1;
      this.dato.color = null;
      this.dato.imagen=null;
    }
  }
}
</script>
