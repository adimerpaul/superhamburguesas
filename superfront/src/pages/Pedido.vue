<template>
<!--<q-page class="q-pa-xs">-->
  <div class="q-pa-xs row ">
    <template v-for="(rubro,index) in rubros" :key="index">
      <div  class="col-12 flex flex-center q-gutter-md" >
        <q-btn color="deep-orange" size="md" class="q-mb-xs"  style="width: 250px">
          <q-icon left :name="rubro.icono" />
          <div class="text-center">
            {{ rubro.nombre }}
          </div>
        </q-btn>
      </div>
      <div class="col-12">
        <div class="row">
          <div v-for="(producto,index) in rubro.productos" :key="index" class=" col-6 col-md-3">
            <q-card   bordered style="" >
              <q-card-section horizontal>
<!--                <q-card-section>-->
                  <q-img
                    style="max-width: 100px"
                    :src="url+'/../imagenes/'+producto.imagen"
                  />
<!--                </q-card-section>-->
                <q-card-section class="q-pa-none q-pl-xs" style="width: 100%">
                  <div>{{producto.nombre}}</div>
                  <div class="text-bold text-red-7">Bs. {{producto.precio}}</div>
                  <div class="text-bold text-red-8 float-right" @click="registro(producto)">
                    <q-icon name="control_point" size="md"/>
                  </div>
                </q-card-section>

              </q-card-section>
            </q-card>
          </div>
        </div>
    <q-dialog v-model="confirm" transition-show="scale" transition-hide="scale">
      <q-card >
        <q-card-section class="bg-teal text-white" >
          <q-avatar icon="fastfood" color="primary" text-color="white" />
          <span class="q-ml-sm">{{prod.nombre}}</span>
        </q-card-section>        
          
          <span class="q-ml-sm">{{prod}}</span>
        <q-card-section class="row items-center" horizontal>
          
          <q-img :src="url+'/../imagenes/'+prod.imagen" class="col-5" spinner-color="white" style="height: 140px; max-width: 150px;" />
          <q-card-section>
          <q-input type="number" label="Cantidad" min="1" v-model="cant"/><br>
          <q-input type="text" readonly label="Precio" v-model="prod.precio" />
          <q-input type="text" readonly label="Subtotal" v-model="subtotal" />
        </q-card-section>

        </q-card-section>
        <q-card-section v-if="prod.tipo=='COMBO'">
          <q-checkbox v-model="right" label="Label on Right" />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancelar" color="primary" v-close-popup />
          <q-btn flat label="Agregar a Pedido" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
      </div>
    </template>

  </div>
<!--</q-page>-->
</template>

<script>
export default {
  name: "Pedido",
  data(){
    return{
      url:process.env.API,
      rubros:[],
      confirm:false,
      prod:{}
    }
  },
  created() {
    // console.log(process.env.API)
    this.$q.loading.show()
    this.$axios.get(process.env.API+'/rubro').then(res=>{
      this.rubros=res.data
      // console.log(res.data)
      this.$q.loading.hide()
    })
  },
  methods: {
    registro(producto){
      this.prod=producto;
      this.confirm=true;
    }
  },
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 350px
</style>
