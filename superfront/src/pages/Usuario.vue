<template>
  <div class="q-pa-md">
    <q-btn
      label="Nuevo Usuario"
      color="positive"
      @click="alert = true"
      icon="add_circle"
      class="q-mb-xs"
    />
    <q-dialog v-model="alert">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-green-14 text-white">
          <div class="text-h6"><q-icon name="add_circle" /> Nuevo Usuario</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
            <div class="row">
              <div class="col-6">
                <q-input
                  filled
                  v-model="dato.name"
                  type="text"
                  label="Nombre "
                  hint="Ingresar Nombre"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />

                <q-input
                  filled
                  v-model="dato.email"
                  type="email"
                  label="Email"
                  hint="Correo electronico"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />

                <q-input
                  filled
                  v-model="dato.password"
                  type="password"
                  label="Contraseña"
                  hint="Contraseña"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
                <q-input
                  filled
                  v-model="dato.carnet"
                  type="text"
                  label="Cedula Identidad*"
                  hint="CI"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
                <q-input
                  filled
                  v-model="dato.celular"
                  type="number"
                  label="Celular*"
                  hint="numero cel"
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />

                <q-select
                  filled
                  v-model="dato.tipo"
                  :options='["ADMIN","CAJERO"]'
                  label="Tipo Usuario*"
                  hint=""
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
                <q-input
                  filled
                  label="Fecha limite"
                  type="date"
                  v-model="dato.fechalimite"
                />
              </div>
            </div>

            <div>
              <q-btn label="Crear" type="submit" color="positive" icon="add_circle" />
              <q-btn label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>

    <q-table :filter="filter" title="Usuarios" 
      :rows="data" 
      :columns="columns" 
      row-key="name" 
      :rows-per-page-options="[50,100]">
      <template v-slot:top-right>
        <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </template>
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="name" :props="props">
            {{props.row.name}}
          </q-td>
          <q-td key="email" :props="props">
            {{props.row.email}}
          </q-td>
        <q-td key="celular" :props="props">
            {{props.row.celular}}
          </q-td>
        <q-td key="carnet" :props="props">
            {{props.row.carnet}}
          </q-td>
          <q-td key="fechalimite" :props="props">
            {{props.row.fechalimite}}
          </q-td>
                    <q-td key="tipo" :props="props">
            {{props.row.tipo}}
          </q-td>
          <q-td key="opcion" :props="props">
          <q-btn
              dense
              round
              flat
              color="yellow"
              @click="editRow(props)"
              icon="edit"
          />
            <q-btn
              dense
              round
              flat
            color="positive"
            @click="cambiopass(props)"
            icon="vpn_key"
            />

            <q-btn
              dense
              round
              flat
              color="red"
              @click="deleteRow(props)"
              icon="delete"
            ></q-btn>
          </q-td>

        </q-tr>
      </template>
    </q-table>
<!--    {{permisos2}}-->
    <q-dialog v-model="dialog_mod">
      <q-card style="max-width: 80%; width: 50%">
        <q-card-section class="bg-warning text-white">
          <div class="text-h6"> <q-icon name="edit"/> Modificar</div>
        </q-card-section>
        <q-card-section class="q-pt-xs">
          <q-form @submit="onMod" class="q-gutter-md">
            <q-input
              filled
              v-model="dato2.name"
              type="text"
              label="Nombre "
              hint="Ingresar Nombre"
              lazy-rules
              :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
            />


            <q-input
              filled
              v-model="dato2.email"
              type="email"
              label="Email"
              hint="Correo electronico"
              lazy-rules
              :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
            />


            <q-input
              filled
              v-model="dato2.celular"
              type="number"
              label="Celular "
              hint="Ingresar numero"
              lazy-rules
              :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
            />
                <q-select
                  filled
                  v-model="dato2.tipo"
                  :options='["ADMIN","CAJERO"]'
                  label="Tipo Usuario*"
                  hint=""
                  lazy-rules
                  :rules="[(val) => (val && val.length > 0) || 'Por favor ingresa datos']"
                />
            <q-input
              filled
              label="Fecha limite"
              type="date"
              v-model="dato2.fechalimite"
            />
            <div>
              <q-btn label="Modificar" type="submit" color="positive" icon="add_circle" />
              <q-btn label="Cancelar" icon="delete" color="negative" v-close-popup />
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>


   <q-dialog v-model="dialog_del">
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="clear" color="red" text-color="white" />
          <span class="q-ml-sm">Seguro de eliminar Registro.</span>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Eliminar" color="deep-orange" @click="onDel" />
          <q-btn flat label="Cancelar" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
    <q-dialog v-model="modelpermiso">
      <q-card style="width: 700px;max-width: 80vw">
        <q-card-section class="bg-info">
          <div class="text-h6 text-white"><q-icon name="folder"/> Permisos Usuario</div>
        </q-card-section>
        <q-card-section>
          <q-form @submit.prevent="updatepermisos">
<!--          v-on:click.native="updatepermiso(permiso)"-->
          <q-checkbox style="width: 100%"  v-for="(permiso,index) in permisos2" :key="index" :label="permiso.nombre" v-model="permiso.estado" />
          <!--          <q-form>-->
<!--&lt;!&ndash;            <q-checkbox v-model="permisos" />&ndash;&gt;-->
<!--          </q-form>-->
            <q-btn  type="submit" color="info" icon="send" label="Actualizar"></q-btn>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import { date } from 'quasar'
const { addToDate } = date

export default {
  data() {
    return {
      alert: false,
      dialog_mod: false,
      dialog_del: false,
      filter:'',
      dato: {
        fechalimite:date.formatDate( addToDate(new Date(),{days:7}) , 'YYYY-MM-DD')
      },
      model:'',
      dato2: {},
      options: [],
      props: [],
      permisos:[],
      permisos2:[],
      modelpermiso:false,
      uni:{},
      columns: [
        {name: "name", align: "left", label: "Nombre ", field: "name", sortable: true,},
        {name: "email", align: "left", label: "Email", field: "email", sortable: true,},
        {name: "celular", align: "left", label: "celular", field: "celular", sortable: true,},
        {name: "fechalimite", align: "left", label: "Fecha limite", field: "fechalimite", sortable: true,},
        {name: "tipo", align: "left", label: "Tipo", field: "tipo", sortable: true,
        },

        { name: "opcion", label: "Opcion", field: "action", sortable: false },
      ],
      data: [],
    };
  },
  created() {
                 if(!this.$store.state.showcase.booladmin )
      {location.href='/';
        return false;
      }
    if (!this.$store.state.boolusuario){
      // this.router.push('/')
    }
    this.misdatos();

  },
  methods: {
      // updatepermiso(permiso){
      //   console.log(permiso)
      // },

    misdatos() {
      this.$q.loading.show();
      this.$axios.post(process.env.API + "/listuser").then((res) => {
        // console.log(res.data)
        this.data = res.data;
        this.$q.loading.hide();
      });
    },

    editRow(item) {
      this.dato2 = item.row
       console.log(this.dato2)
      this.dialog_mod = true;
    },
    deleteRow(item) {
      this.dato2 = item.row;
      this.dialog_del = true;
    },

    onSubmit() {
      this.$q.loading.show();
      // this.dato.unid_id=this.dato.unid_id.id;
      this.$axios.post(process.env.API + "/regempleado", {
        name:this.dato.name,
        password:this.dato.password,
        email:this.dato.email,
        celular:this.dato.celular,
        carnet:this.dato.carnet,
        tipo:this.dato.tipo,
        fechalimite:this.dato.fechalimite,
      }).then((res) => {
        this.$q.notify({
          color: "green-4",
          textColor: "white",
          icon: "cloud_done",
          message: "Creado correctamente",
        });
        this.dato={fechalimite:date.formatDate(Date.now(), 'YYYY-MM-DD')}
        this.alert = false;
        this.misdatos();
      }).catch(err=>{
        console.log(err.response.data);
        this.$q.notify({
          message:err.response.data.message,
          icon:'close',
          color:'red'
        })
        this.$q.loading.hide()
      })
    },
    onMod() {
      this.$q.loading.show();
      console.log(this.dato2)
      this.$axios.post(process.env.API + "/modempleado" , this.dato2).then((res) => {
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: "Modificado correctamente",
          });
          this.dialog_mod = false;
          this.misdatos();
        });
    },

    onDel() {
      this.$q.loading.show();
      this.$axios.post(process.env.API + "/delempleado" , this.dato2)
        .then((res) => {
        this.$q.notify({
          color: "green-4",
          textColor: "white",
          icon: "cloud_done",
          message: "Eliminado correctamente",
        });
        this.dialog_del = false;
        this.misdatos();
      }).catch(err=>{
        this.$q.loading.hide()
        this.$q.notify({
          message:err.response.data.message,
          icon:'error',
          color:'red'
        })
      })
    },

    onReset() {
      this.dato.nombre = null;
      this.dato.inicio = 0;
      this.dato.fin = 0;
    },
    cambiopass (i) {
      // console.log(i.row);
      this.$q.dialog({
        title: 'Cambiar password',
        message: 'Ingresar nueva contraseña',
        prompt: {
          model: '',
          type: 'password' // optional
        },
        cancel: true,
      }).onOk(data => {
        this.$axios.post(process.env.API+'/passempleado/',{id:i.row.id,password:data}).then(res=>{
                    this.$q.notify({
          message:'Modificado pass',
          icon:'send',
          color:'green'
        })
        this.misdatos();
        })
      }).onCancel(() => {
      }).onDismiss(() => {
      })
    }
  },
};
</script>
