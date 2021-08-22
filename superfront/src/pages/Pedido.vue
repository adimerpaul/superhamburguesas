<template>
  <!--<q-page class="q-pa-xs">-->
  <div class=" row ">
    <h5>SUCURSAL {{agencianombre}}</h5>
    <div v-for="(rubro,index) in rubros" :key="index"  class="col-4 col-sm-2 q-pa-xs" >
      <q-btn color="primary"  class="full-width q-pa-none q-ma-none" @click="scrollMeTo(rubro.nombre)"  :label="rubro.nombre" :icon="rubro.icono" size="md"/>
    </div>
  </div>
  <div class="q-pa-xs row">
    <template v-for="(rubro,index) in rubros" :key="index">
      <div  class="col-12 flex flex-center q-gutter-md" >
<!--        <q-btn :ref="rubro.nombre" color="deep-orange"  class="q-mb-none " style="width: 250px" size="sm" :label="rubro.nombre" :icon="rubro.icono">-->
          <!--          <q-icon left :name="rubro.icono" />-->
          <!--          <div class="text-center">-->
          <!--            {{ rubro.nombre }}-->
          <!--          </div>-->
<!--        </q-btn>-->
        <button :ref="rubro.nombre" style="width: 100%;background: #F2C037;border: 0px;color: white"><q-icon :name="rubro.icono" size="sm"/> {{ rubro.nombre }}</button>
<!--        <q-btn :name="rubro.nombre">{{ rubro.nombre }}</q-btn>-->
      </div>
      <div class="col-12">
        <div class="row">
          <div v-for="(producto,index) in rubro.productos" :key="index" class=" col-6 col-md-3">
            <q-card   bordered class="q-ma-xs"  @click="menu(producto)">
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
                  <div class="text-bold text-red-8 float-right">
                    <div class="text-bold text-white">Bs. {{producto.precio}}</div>
                  </div>
                </q-card-section>

              </q-card-section>
            </q-card>
          </div>
        </div>
      </div>
    </template>

  </div>
  <q-dialog v-model="card">
    <q-card class="my-card" style="width: 700px; max-width: 80vw;">
      <q-form >
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-6">
              <q-img :src="url+'/../imagenes/'+producto.imagen" sizes="xs" >
                <div class="absolute-bottom text-subtitle1 text-center">
                  {{ producto.nombre }}
                </div>
              </q-img>
            </div>
            <div class="col-6">
              <div class="row  items-center q-pa-md">
                  <div class="col-12 text-h6 ">
                    {{ producto.descripcion }} {{ producto.precio }} Bs.
                    <q-toolbar-title>
                      <!--          Quasar App-->
                    </q-toolbar-title>
                    <q-card-section class="q-pt-none">
                      <div class="text-subtitle1">
                      </div>
                      <div v-for="(incluye,index) in producto.incluyes" :key="index" class="text-caption text-grey">
                        - {{ incluye.nombre }}
                      </div>
                    </q-card-section>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-6 q-pa-xs">
<!--              <q-input outlined label="Precio"  hint="Precio de venta"   :model-value="producto.precio+' Bs'" />-->
<!--              <q-input bg="bg-teal text-white" v-model="producto.precio" label="Custom standout"  />-->
              <q-input  label-color="black" bg-color="yellow" filled :model-value="producto.precio+' Bs'" label="Precio" disable/>
            </div>
            <div class="col-6 q-pa-xs">
              <q-select  label-color="black" bg-color="yellow" filled v-model="cantidad" :options="cantidades" label="Cantidad" />
<!--              <q-select outlined label="Cantidad" v-model="cantidad" :options="cantidades"/>-->
            </div>
          </div>
        </div>
      </div>
<!--      <q-card-section>-->
<!--&lt;!&ndash;        <q-btn&ndash;&gt;-->
<!--&lt;!&ndash;          fab&ndash;&gt;-->
<!--&lt;!&ndash;          color="primary"&ndash;&gt;-->
<!--&lt;!&ndash;          icon="place"&ndash;&gt;-->
<!--&lt;!&ndash;          class="absolute"&ndash;&gt;-->
<!--&lt;!&ndash;          style="top: 0; right: 12px; transform: translateY(-50%);"&ndash;&gt;-->
<!--&lt;!&ndash;        />&ndash;&gt;-->


<!--&lt;!&ndash;          <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">&ndash;&gt;-->
<!--&lt;!&ndash;            <q-icon name="place"  />&ndash;&gt;-->
<!--&lt;!&ndash;            250 ft&ndash;&gt;-->
<!--&lt;!&ndash;          </div>&ndash;&gt;-->

<!--&lt;!&ndash;        <q-rating v-model="stars" :max="5" size="32px" />&ndash;&gt;-->
<!--      </q-card-section>-->
      <q-separator />

      <q-card-actions align="around" class="bg-primary">
<!--        <q-btn v-close-popup flat label="Reserve" />-->
        <div class="text-h5 text-bold text-yellow-14" >{{subtotal}} Bs</div>
        <div class="text-h5 text-bold text-white" >AGREGAR</div>
<!--        <q-btn v-close-popup flat round icon="event" />-->
      </q-card-actions>
      </q-form>
    </q-card>
  </q-dialog>


  <q-page-sticky position="bottom-right" :offset="[15, 15]">
    <q-btn fab icon="keyboard_arrow_up" color="primary" @click="subir"/>
  </q-page-sticky>


  <!--</q-page>-->
</template>

<script>
export default {
  name: "Pedido",
  data(){
    return{
      url:process.env.API,
      rubros:[],
      card:false,
      stars:3,
      producto:{},
      cantidad:1,
      cantidades:[]
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
  mounted() {
    for (let i=1;i<=100;i++) {
      this.cantidades.push(i)
    }
  },
  methods:{
    menu(product){
      console.log(product)
      this.producto=product
      this.card=true
    },
    scrollMeTo(refName){
      // console.log(rubro)
      var element = this.$refs[refName];
      var top = element.offsetTop;
      // console.log(top)
      window.scrollTo(0, top-130);
    },
    subir(){
      window.scrollTo(0, 0);
    }
  },
  computed:{
    subtotal(){
      return this.producto.precio*this.cantidad
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 350px
</style>
