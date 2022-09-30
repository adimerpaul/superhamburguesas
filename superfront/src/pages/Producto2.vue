<template>
  <div class="q-pa-xs">
  <div class="row">
    <div class="col-12">
      <q-form @submit.prevent="agregarproducto">
        <div class="row">
          <div class="col-3 q-pa-xs"><q-input label="Nombre" outlined v-model="dato.nombre" required/></div>
          <div class="col-3 q-pa-xs"><q-input label="Precio" type="number" step="0.01" outlined v-model="dato.precio" required/></div>
          <div class="col-3 q-pa-xs"><q-input label="Descripcion" outlined v-model="dato.descripcion" required/></div>
<!--          <div class="col-3 q-pa-xs">-->
<!--            <q-select outlined label="Rubro" :options="rubros" option-label="nombre" v-model="dato.rubro" required/>-->
<!--          </div>-->
          <div class="col-3 q-pa-xs flex flex-center"> <q-btn color="green" label="Agregar" icon="send" type="submit"/></div>
        </div>
      </q-form>
    </div>
    <div class="col-12">
      <q-card>
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="white"
          indicator-color="primary"
          active-bg-color="red"
          align="justify"
          narrow-indicator
        >
          <q-tab  @click="misproductos(r)" v-model="rubro" v-for="(r,i) in rubros" :key="i" :name="r.id" :label="r.nombre" />
        </q-tabs>
        <q-separator />
        <q-tab-panels v-model="tab" animated>
          <q-tab-panel v-for="(r,i) in rubros" :name="r.id" :key="i">
<!--            <div class="text-h6">Mails</div>-->
<!--            Lorem ipsum dolor sit amet consectetur adipisicing elit.-->
            <div class="row">
              <div class=" q-pa-xs col-12 col-md-4"  v-for="(p,j) in productos" :key="j">
                <q-card class="my-card"  >
                  <q-img @click="cambiarimg(p)" :src="url+'/../imagenes/'+p.imagen" />
                  <q-card-section >
<!--                    <q-btn-->
<!--                      fab-->
<!--                      color="primary"-->
<!--                      icon="add_shopping_cart"-->
<!--                      class="absolute"-->
<!--                      style="top: 0; right: 12px; transform: translateY(-50%);"-->

<!--                    />-->
<!--                    @click="showpedido(p)"-->
                    <div class="row no-wrap items-center">
                      <div class="col text-h6 ellipsis">
                        <div class="row">
                          <div class="col-8">
                            <q-input outlined v-model="p.nombre" label="Nombre producto" @keyup="mistart(p)" />
                          </div>
                          <div class="col-2 flex flex-center">
                            <q-icon
                              :color="p.mostrar ? 'green' : 'red'"
                              :name="p.mostrar ? 'visibility' : 'visibility_off'"
                              class="cursor-pointer"
                              @click="ocultar(p)"
                            />
                          </div>
                          <div class="col-2 flex flex-center">
                            <q-icon
                              color="red"
                              name="delete"
                              class="cursor-pointer"
                              @click="borrarproducto(p)"
                            />
                          </div>
                        </div>


                      </div>
                      <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                        <q-icon name="place" />
                        {{p.precio}} Bs
                      </div>
                    </div>
                    <q-rating @click="mistart(p)" v-model="p.star" :max="5" size="32px" />
                  </q-card-section>

                  <q-card-section class="q-pt-none">
                    <div class="text-subtitle1">
                      <q-input outlined v-model="p.precio" type="number" step="0.01" label="Precio producto BS" @keyup="mistart(p)"/>
                    </div>
                    <div class="text-caption text-grey">
<!--                      {{p.descripcion}}-->
                      <q-input outlined v-model="p.descripcion" label="Descripcion" @keyup="mistart(p)"/>
                    </div>
                    <div class="row">
                      <div class="col-10">

                        <input type="text" placeholder="Incluye" style="width: 100%" v-model="p.incluye">
                      </div>
                      <div class="col-2 flex flex-center">
                        <q-btn size="xs" @click="insertincluye(p)" color="green"><q-icon name="send"/>  </q-btn>
                      </div>
                      <div class="col-12">
                        <template v-for="(inc,k) in p.incluyes" :key="k" > {{inc.nombre}} <q-icon @click="borrarincluye(inc,k,p)" color="red" name="delete"/>, </template>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <select v-model="p.productocombo" style="width: 100%">
                          <option  v-for="pr in productoscombo" :key="pr.i" :value="pr.id">{{pr.nombre}}</option>
                        </select>
                      </div>
                      <div class="col-4 flex flex-center">
                        <input type="radio" name="tipo" v-model="p.tipo2" value="JUGO" > Jugo <input type="radio" name="tipo" v-model="p.tipo2" value="AGREGADO"> Agregado
                      </div>
                      <div class="col-2 flex flex-center">
                        <q-btn size="xs" @click="insertcombo(p)" color="green"><q-icon name="send"/>  </q-btn>
                      </div>
                      <div class="col-12">
                        <ul>
                          <li v-for="(c,k) in p.combos" :key="c.id">{{ c.tipo }} - {{ c.nombre }} <q-icon @click="borrarcombo(c,k,p)" color="red" name="delete"/></li>
                        </ul>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-4">
                        <input v-model="p.nombresubproducto" placeholder="Nombre Subproducto" style="width: 100%"/>
                      </div>
                      <div class="col-3 ">
                        <input v-model="p.preciosubproducto" placeholder="Precio" step="0.01" style="width: 100%" type="number"/>
                      </div>
                      <div class="col-2 ">
                        <input v-model="p.cantidadsubproducto" placeholder="Cantidad" style="width: 100%" type="number"/>
                      </div>
                      <div class="col-3 flex flex-center">
                        <q-btn size="xs" @click="insertsubproducto(p)" color="green"><q-icon name="send"/>  </q-btn>
                      </div>
                      <div class="col-12">
                        <ul>
                          <li v-for="(s,k) in p.subproductos" :key="s.id">{{ s.precio }}Bs. - {{ s.nombre }} - {{ s.cantidad }} <q-icon @click="borrarsubproducto(s,k,p)" color="red" name="delete"/></li>
                        </ul>
                      </div>
                    </div>


                  </q-card-section>

                  <q-separator />

                  <!--                <q-card-actions>-->
                  <!--                  <q-btn flat round icon="event" />-->
                  <!--                  <q-btn flat color="primary">-->
                  <!--                    Reserve-->
                  <!--                  </q-btn>-->
                  <!--                </q-card-actions>-->
                </q-card>
              </div>
            </div>
          </q-tab-panel>
        </q-tab-panels>
      </q-card>
    </div>
  </div>

    <q-dialog v-model="alert">
      <q-card>
        <q-card-section>
          <div class="text-h6">Cambiar imagen</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-uploader
            style="max-width: 300px"
            label="Main Image"
            :factory="uploadFile"
            max-files="1"
            accept=".jpg,.png, image/*"
          />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="OK" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>



  </div>
</template>

<script>
import {date} from "quasar";
export default {
  data () {
    return{
      tab:1,
      rubros:[],
      rubro:'',
      productos:[],
      productoscombo:[],
      producto:'',
      url:process.env.API,
      isPwd:true,
      alert:false,
      // incluye:''
      imagen:'',
      dato:{}
    }
  },
  created() {
                     if(!this.$store.state.showcase.booladmin )
      {location.href='/';
        return false;
      }
    this.misrubros();
    this.misproductoscombo();
  },
  methods:{
    agregarproducto(){
      this.dato.rubro_id=this.tab
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/crearproducto',this.dato).then(res=>{
        // this.productoscombo=res.data
        this.$q.loading.hide()
        this.dato={}
        this.misrubros()
      })
    },
    misproductoscombo(){
      this.$axios.get(process.env.API+'/producto').then(res=>{
        this.productoscombo=res.data
      })
    },
    uploadFile(files) {
      let file_path = files[0]
      const fileData = new FormData()
      fileData.append('imagen',file_path)
      fileData.append('id',this.producto.id)
      // console.log(fileData);
      //Replace http://localhost:8000 with your API URL
      this.$q.loading.show()
      const uploadFile = this.$axios.post(process.env.API+'/upload5', fileData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then((response) => {
        // console.log(this.rubro);
        this.$q.loading.hide()
        this.alert=false
        this.misproductos(this.rubro)
        this.imagen=response.data;
        this.$q.notify({
          color: 'green-4',
          textColor: 'white',
          icon: 'cloud_done',
          message: 'Imagen subido correctamente!'
        });
      });
    },
   misrubros(){
     this.$q.loading.show()
     this.$axios.get(process.env.API+'/rubro').then(res=>{
       this.rubros=res.data
       this.rubro=this.rubros[0]
       // console.log(this.rubro)
       // this.$q.loading.hide()
       this.misproductos(this.rubros[0])
     })
   },
    cambiarimg(p){
     this.alert=true
      this.producto=p
    },
    misproductos(rubro){
      this.$q.loading.show()
      this.productos=[]
      this.$axios.get(process.env.API+'/misproductosrubros/'+rubro.id).then(res=>{
        this.$q.loading.hide()
        // console.log(this.productos)
        this.productos=res.data
        // console.log(this.productos)
      })
    },
    mistart(p){
     // console.log(p)
      this.$axios.put(process.env.API+'/producto/'+p.id,p).then(res=>{
      })
    },
    insertincluye(p){
      if(p.incluye=='' || p.incluye==undefined){
        this.$q.notify({
          message:'Debes selecionar incluye',
          color:'red',
          icon:'error'
        })
        return false
      }
     this.$q.loading.show()
      this.$axios.post(process.env.API+'/incluye',{producto_id:p.id,nombre:p.incluye}).then(res=>{
        // console.log(res.data)
        p.incluye=''
        p.incluyes.push(res.data)
        this.$q.loading.hide()
      })
    },
    insertcombo(p){
      // console.log(p)
      // return false
      if(p.productocombo=='' || p.productocombo==undefined) {
        this.$q.notify({
          message: 'Debes selecionar producto',
          color: 'red',
          icon: 'error'
        })
        return false
      }
        if(p.tipo2=='' || p.tipo2==undefined){
          this.$q.notify({
            message:'Debes selecionar Tipo',
            color:'red',
            icon:'error'
          })
        return false
      }
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/combo',{producto_id:p.id,producto_id2:p.productocombo,tipo:p.tipo2}).then(res=>{
        // console.log(res.data)
        p.productocombo=''
        p.combos.push(res.data)
        this.$q.loading.hide()
      })
    },
    insertsubproducto(p){
      // console.log(p)
      // return false
      if(p.nombresubproducto=='' || p.nombresubproducto==undefined) {
        this.$q.notify({
          message: 'Debes selecionar Nombre subproducto',
          color: 'red',
          icon: 'error'
        })
        return false
      }
      if(p.preciosubproducto=='' || p.preciosubproducto==undefined) {
        this.$q.notify({
          message: 'Debes selecionar precio',
          color: 'red',
          icon: 'error'
        })
        return false
      }
      if(p.cantidadsubproducto=='' || p.cantidadsubproducto==undefined) {
        this.$q.notify({
          message: 'Debes selecionar cantidad',
          color: 'red',
          icon: 'error'
        })
        return false
      }
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/subproducto',{
        producto_id:p.id,
        nombre:p.nombresubproducto,
        precio:p.preciosubproducto,
        cantidad:p.cantidadsubproducto,
      }).then(res=>{
        // console.log(res.data)
        p.nombresubproducto=''
        p.preciosubproducto=''
        p.cantidadsubproducto=''
        p.subproductos.push(res.data)
        this.$q.loading.hide()
      })
    },
    borrarincluye(i,k,p){
      this.$q.loading.show()
      this.$axios.delete(process.env.API+'/incluye/'+i.id).then(res=>{
        // console.log(res.data)
        // p.incluye=''
        p.incluyes.splice(k,1)
        this.$q.loading.hide()
      })
    },
    borrarcombo(i,k,p){
      this.$q.loading.show()
      this.$axios.delete(process.env.API+'/combo/'+i.id).then(res=>{
        // console.log(res.data)
        // p.incluye=''
        p.combos.splice(k,1)
        this.$q.loading.hide()
      })
    },
    borrarsubproducto(i,k,p){
      this.$q.loading.show()
      this.$axios.delete(process.env.API+'/subproducto/'+i.id).then(res=>{
        // console.log(res.data)
        // p.incluye=''
        p.subproductos.splice(k,1)
        this.$q.loading.hide()
      })
    },
    ocultar(p){
      p.mostrar = !p.mostrar
      this.mistart(p)
    },
    borrarproducto(p){
      this.$q.dialog({
        title:'Seguro de borrar?',
        // title:'info',
        cancel:true,
      }).onOk(()=>{
        this.$q.loading.show()
        this.$axios.delete(process.env.API+'/producto/'+p.id).then(res=>{
          // console.log(res.data)
          // p.incluye=''
          // p.combos.splice(k,1)
          this.misproductos(this.rubro)
          this.$q.loading.hide()
        })
      })

    }
  }
}
</script>
