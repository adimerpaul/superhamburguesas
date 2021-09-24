<template>
  <q-page class="q-pa-xs">
    <q-card>
      <q-tabs
        v-model="tab"
        dense
        class="text-grey"
        active-color="primary"
        indicator-color="primary"
        align="justify"
        narrow-indicator
      >
        <q-tab :name="r.id" :label="r.nombre" v-for="(r,i) in rubros" :key="i" />
<!--        <q-tab name="alarms" label="Alarms" />-->
<!--        <q-tab name="movies" label="Movies" />-->
      </q-tabs>

      <q-separator />

      <q-tab-panels v-model="tab" animated>
        <q-tab-panel :name="r.id" v-for="(r,i) in rubros" :key="i" >
<!--          <div class="text-h6">{{ r.nombre }}</div>-->
          <div class="row">
            <div class=" q-pa-xs col-12 col-md-4"  v-for="(p,j) in r.productos" :key="j">
              <q-card class=" my-card"  >
                <q-img :src="url+'/../imagenes/'+p.imagen" />
                <q-card-section>
                  <q-btn
                    fab
                    color="primary"
                    icon="add_shopping_cart"
                    class="absolute"
                    style="top: 0; right: 12px; transform: translateY(-50%);"
                    @click="showpedido(p)"
                  />
                  <div class="row no-wrap items-center">
                    <div class="col text-h6 ellipsis">
                      {{p.nombre}}
                    </div>
                    <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                      <q-icon name="place" />
                      {{p.precio}} Bs
                    </div>
                  </div>
                  <q-rating v-model="stars" :max="5" size="32px" />
                </q-card-section>

                <q-card-section class="q-pt-none">
                  <div class="text-subtitle1">
                    {{p.precio}} Bs <template v-if="p.incluyes.length>0">・</template><template v-for="(inc,k) in p.incluyes" :key="k"> {{inc.nombre}} , </template>
                  </div>
                  <div class="text-caption text-grey">
                    {{p.descripcion}}
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
<!--    <q-page-sticky position="bottom-right" :offset="[18, 18]">-->

<!--    <q-fab-->
<!--      v-model="fabRight"-->
<!--      vertical-actions-align="right"-->
<!--      color="primary"-->
<!--      glossy-->
<!--      icon="shop"-->
<!--      direction="up"-->
<!--    >-->
<!--      <q-fab-action v-for="(r,i) in rubros" :key="i" label-position="left" color="accent" @click="onClick" icon="mail" :label="r.nombre"  />-->
<!--&lt;!&ndash;      <q-fab-action label-position="left" color="secondary" @click="onClick" icon="alarm" label="Alarm" />&ndash;&gt;-->
<!--&lt;!&ndash;      <q-fab-action label-position="left" color="orange" @click="onClick" icon="airplay" label="Airplay" />&ndash;&gt;-->
<!--&lt;!&ndash;      <q-fab-action label-position="left" color="accent" @click="onClick" icon="room" label="Map" />&ndash;&gt;-->
<!--    </q-fab>-->
<!--    </q-page-sticky>-->

    <q-dialog v-model="modalpedido">
      <q-card>
<!--        <q-card-section>-->
<!--          <div class="text-h6">Alert</div>-->
<!--        </q-card-section>-->
        <q-card-section class="q-pt-none">
          <q-card >
            <q-img :src="url+'/../imagenes/'+producto.imagen" />
            <q-card-section>
              <q-btn
                fab
                color="primary"
                icon="add_shopping_cart"
                class="absolute"
                style="top: 0; right: 12px; transform: translateY(-50%);"
                @click="showpedido(p)"
              />
              <div class="row no-wrap items-center">
                <div class="col text-h6 ellipsis">
                  {{producto.nombre}}
                </div>
                <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                  <q-icon name="place" />
                  {{producto.precio}} Bs
                </div>
              </div>
              <q-rating v-model="stars" :max="5" size="32px" />
            </q-card-section>

            <q-card-section class="q-pt-none">
              <div class="text-subtitle1">
                {{producto.precio}} Bs <template v-if="producto.incluyes.length>0">・</template><template v-for="(inc,k) in producto.incluyes" :key="k"> {{inc.nombre}} , </template>
              </div>
              <div class="text-caption text-grey">
                {{producto.descripcion}}
              </div>
              <div class="row">
                <div class="col-12">
                  <q-select :options="cantidades" v-model="cantidad" label="Cuanto deseas" outlined />
                </div>
                <div class="col-12">
                  <q-badge color="primary" label="Selecionar Jugo" v-if="jugos.length>0" class="full-width"/>
                  <q-option-group :options="jugos" v-model="jugo" />
                </div>
                <div class="col-12">
                  <q-badge color="primary" label="Selecionar Agregado" v-if="agregados.length>0" class="full-width"/>
                  <q-option-group :options="agregados" v-model="agregado" model-value="nombre" />
                </div>
                <div class="col-12">
<!--                  <q-badge color="teal"  v-if="agregados.length>0" class="full-width">-->
<!--                    Subtotal <br>-->
<!--                    {{subtotal}}-->
<!--                  </q-badge>-->
                  <q-banner class="text-center bg-red text-bold text-white" >
                    Subtotal <br>
                    {{subtotal}}
                  </q-banner>
                </div>
                <div class="col-12 q-pt-xs">
                  <q-btn @click="agregar" icon="shop" label="Agregar" color="primary" class="full-width "/>
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
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat label="Cancelar" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>
<script>
export default {
  name: "Pedido",
  data(){
    return{
      agencia_id:3,
      stars:5,
      rubros:[],
      modalpedido:false,
      producto:{},
      fabRight:false,
      tab:1,
      jugos:[],
      jugo:'',
      agregado:'',
      agregados:[],
      url:process.env.API,
      cantidades:[],
      cantidad:1,
      precio:0,
    }
  },
  created() {
    for (let i=1;i<=100;i++){
      this.cantidades.push(i)
    }
    this.$q.loading.show()
    this.$axios.post(process.env.API+'/misproductos',{agencia_id:this.agencia_id}).then(res=>{
      // console.log(res.data)
      // return false
      // this.rubros=res.data
      res.data.forEach(r=>{
        // console.log(r.productos.length)
        if (r.productos.length>0)
          this.rubros.push(r)
      })
      this.$q.loading.hide()
    })
  },
  methods:{
    agregar(){
      // console.log(this.jugo=='')
      // console.log(this.jugos.length>0)
      let subdetalle=[]
      if (this.jugos.length>0 && this.jugo==''){
        this.$q.notify({
          message:'Debes selecionar Jugo',
          color:'red',
          icon:'error'
        })
        return false
      }else{
        // console.log(this.jugo)
        // return false
        if (this.jugos.length>0)
        subdetalle.push({
          nombre:this.jugo.nombre,
          tipo:this.jugo.tipo,
          cantidad:this.cantidad,
        })
      }
      if (this.agregados.length>0 && this.agregado==''){
        this.$q.notify({
          message:'Debes selecionar Agregado',
          color:'red',
          icon:'error'
        })
        return false
      }else{
        if (this.jugos.length>0)
        subdetalle.push({
          nombre:this.agregado.nombre,
          tipo:this.agregado.tipo,
          cantidad:this.cantidad,
        })
      }

      this.$store.dispatch("showcase/mipedido",{
        nombre:this.producto.nombre,
        precio:this.producto.precio,
        cantidad:this.cantidad,
        subtotal:this.subtotal,
        agencia_id:this.agencia_id,
        producto_id:this.producto.id,
        subdetalle:subdetalle
      })
      this.modalpedido=false
      this.$q.notify({
        message:'Agregado  a mis pedidos',
        color:'green',
        icon:'shop'
      })
    },
    showpedido(p){
      this.precio=p.precio
      this.cantidad=1
      this.producto=p
      this.modalpedido=true
      this.jugo=''
      this.jugos=[]
      this.agregado=''
      this.agregados=[]
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/combo/'+p.id).then(res=>{
        // console.log(res.data)
        this.$q.loading.hide()
        res.data.forEach(r=>{
          // console.log(r)
          r.label=r.nombre
          r.value=r
          if (r.tipo=='JUGO'){
            this.jugos.push(r)
          }
          if (r.tipo=='AGREGADO'){
            this.agregados.push(r)
          }

        })
        // console.log(this.dato2);
      })
    },
    onClick(){

    }
  },
  computed:{
    subtotal(){
      return this.precio*this.cantidad
    }
  }
}
</script>
<style lang="sass" scoped>
.my-card
  width: 100%
  //max-width: 300px
</style>
