<template>
  <div class="q-pa-md">
    <q-btn  label="Crear Rubro" color="positive" @click="alert = true" icon="add_circle" class="q-mb-xs" />
    <q-dialog v-model="alert">
      <q-card>
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6">Crear</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form
            @submit="onSubmit"
            @reset="onReset"
            class="q-gutter-md"
          >
            <q-input
              filled
              v-model="dato.nombre"
              label="Nombre"
              hint="Ingresar nombre"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'Por favor ingresa datos']"
            />

            <q-uploader
              style="max-width: 300px"
              label="Main Image"
              :factory="uploadFile"
              max-files="1"
              accept=".jpg,.png, image/*"
            />

            <div>
              <q-btn label="Crear" type="submit" color="positive" icon="add_circle"/>
                <q-btn  label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
        </q-card-section>


      </q-card>
    </q-dialog>
    <q-table
      title="Rubros"
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
            <!--            <q-badge color="purple">-->
            <div :style="'background: '+props.row.color" style="border-radius: 25px;" v-if="props.row.imagen!=''">
              <img :src="url+'/../imagenes/'+props.row.imagen"  width="50" >
            </div>
<!--            </q-badge>-->
          </q-td>
          <q-td key="products" :props="props">
            <div v-for="item in props.row.products" :key="item.id">
              <q-btn  :label="item.nombre" size="xs" color="teal" />
            </div>

          </q-td>
          <q-td key="opcion" :props="props">
              <q-btn  dense round flat color="yellow" @click="editRow(props)" icon="edit"></q-btn>
              <q-btn  dense round flat color="info" @click="editImg(props)" icon="photo"></q-btn>
              <q-btn  dense round flat color="red" @click="deleteRow(props)" icon="delete"></q-btn>
          </q-td>
        </q-tr>
      </template>
    </q-table>



    <q-dialog v-model="dialog_mod">
      <q-card>
        <q-card-section class="bg-amber-14 text-white">
          <div class="text-h6"><q-icon name="edit"/>Modificar</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
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

            <div>
              <q-btn label="Modificar" type="submit" color="warning" icon="edit"/>
                <q-btn  label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <q-dialog v-model="dialog_img">
      <q-card>
        <q-card-section class="bg-amber-14 text-white">
          <div class="text-h6"><q-icon name="edit"/>Modificar imagen</div>
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
              <q-btn label="Modificar" type="submit" color="warning" icon="edit"/>
              <q-btn  label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
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


  </div>
</template>

<script>
export default {
  data () {
    return {
      alert: false,
      url: process.env.API,
      file_path : null,
      name: null,
      age: null,
      accept: false,
      dato:{},
      dato2:{},
      dialog_mod:false,
      dialog_img:false,
      dialog_del:false,
      props:[],
      columns: [
        {
          name: 'nombre',
          required: true,
          label: 'Nombre',
          align: 'left',
          field: row => row.nombre,
          sortable: true
        },
        { name: 'imagen', align: 'center', label: 'imagen', field: 'imagen', sortable: true },
        { name: 'opcion', label: 'Opcion', field:'action',  sortable: false },

      ],
      data: [
        // {
        //   nombre: 'Frozen Yogurt',
        //   color: 'red',
        //   imagen:'1.png'
        // }
      ],
      uploadPercentage: 0,
    }
  },
  created() {
                     if(!this.$store.state.showcase.booladmin )
      {location.href='/';
        return false;
      }
    this.misdatos();
    // this.$q.notify({
    //   color: 'green-4',
    //   textColor: 'white',
    //   icon: 'cloud_done',
    //   message: 'Imagen subido correctamente!'
    // });
    // this.$router.push('login')
  },
  // preFetch ({ store, redirect }) {
  //   if (!store.getters['showcase/isLoggedIn']) {
  //     redirect({ path: '/login' })
  //   }
  //   // console.log(store.getters['showcase/isLoggedIn'])
  // },
  methods:{
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
        // Notify plugin needs to be installed
        // https://quasar.dev/quasar-plugins/notify#Installation
        // this.$q.notify({
        //   type: 'possitive',
        //   message: `Image Uploaded`
        // })
      });
    },
    uploadFile2(files) {
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
        this.dato2.imagen=response.data;
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Imagen subido correctamente!'
        });
        // Notify plugin needs to be installed
        // https://quasar.dev/quasar-plugins/notify#Installation
        // this.$q.notify({
        //   type: 'possitive',
        //   message: `Image Uploaded`
        // })
      });
    },
    onRejected (rejectedEntries) {
      // Notify plugin needs to be installed
      // https://quasar.dev/quasar-plugins/notify#Installation
      this.$q.notify({
        type: 'negative',
        message: `${rejectedEntries.length} file(s) did not pass validation constraints`
      })
    },
    misdatos(){
      this.$q.loading.show();
      this.$axios.get(process.env.API+'/rubro').then(res=>{
         // console.log(res.data)
        this.data=res.data;
        this.$q.loading.hide();
      })
    },
    onSubmit () {
      this.$q.loading.show();
      // if (this.accept !== true) {
      //   this.$q.notify({
      //     color: 'red-5',
      //     textColor: 'white',
      //     icon: 'warning',
      //     message: 'You need to accept the license and terms first'
      //   })
      // }
      // else {
      //   this.$q.notify({
      //     color: 'green-4',
      //     textColor: 'white',
      //     icon: 'cloud_done',
      //     message: 'Submitted'
      //   })
      // }
      // let nombre=this.dato.nombre;
      // let imagen=this.dato.imagen;
      // let color=this.dato.color;
      // console.log({nombre,imagen,color})
      // return false;
      this.$axios.post(process.env.API+'/rubro', this.dato).then(res=>{
        // console.log(res.data)
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Creado correctamente'
        });
        this.alert=false;
        this.misdatos();
      })
      //   .catch(err=>{
      //   this.alert=false;
      //     this.$q.notify({
      //       color: 'red-5',
      //       textColor: 'white',
      //       icon: 'warning',
      //       message: err.message
      //     })
      // })

    },
    editRow(rubro){
        // console.log(rubro.row);
        this.dato2= rubro.row;
        this.dialog_mod=true;
    },
    editImg(rubro){
      // console.log(rubro.row);
      this.dato2= rubro.row;
      this.dialog_img=true;
    },
    deleteRow(rubro){
        // console.log(rubro.row);
        this.dato2= rubro.row;
        this.dialog_del=true;

    },
    onMod(){
        this.$q.loading.show();
        this.$axios.put(process.env.API+'/rubro/'+this.dato2.id,this.dato2).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Modificado correctamente'
        });
        this.dialog_mod=false;
        this.dialog_img=false;
        this.misdatos();
        }).catch(err=>{
          this.$q.notify({
            color: 'red-4',
            textColor: 'white',
            icon: 'logout',
            message: 'Modificado correctamente'
          });
          this.dialog_mod=false;
          this.$q.loading.hide();
        })
    },
    onDel(){
        this.$q.loading.show();
        this.$axios.delete(process.env.API+'/rubro/'+this.dato2.id).then(res=>{
         this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Eliminado correctamente'
        });
        this.dialog_del=false;
        this.misdatos();
        }).catch(err=>{
        this.$q.notify({
          color: 'red-4',
          textColor: 'white',
          icon: 'logout',
          message: err.message
        });
          this.dialog_del=false;
          this.$q.loading.hide();
      })
    },
    onReset () {
      this.name = null
      this.age = null
      this.accept = false
    }
  }
}
</script>
