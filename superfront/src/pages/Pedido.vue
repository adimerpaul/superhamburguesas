<template>
  <!--<q-page class="q-pa-xs">-->
  <div class=" row ">
    <div v-for="(rubro,index) in rubros" :key="index"  class="col-4 col-sm-3 q-pa-xs" >
      <q-btn color="primary"  class="full-width" @click="scrollMeTo(rubro.nombre)"  :label="rubro.nombre" :icon="rubro.icono"/>
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
            <q-card   bordered class="q-ma-xs" >
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
                    <q-icon name="control_point" size="md"/>
                  </div>
                </q-card-section>

              </q-card-section>
            </q-card>
          </div>
        </div>
      </div>
    </template>

  </div>

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
      rubros:[]
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
  methods:{
    scrollMeTo(refName){
      // console.log(rubro)
      var element = this.$refs[refName];
      var top = element.offsetTop;
      console.log(top)
      window.scrollTo(0, top-130);
    },
    subir(){
      window.scrollTo(0, 0);
    }
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 350px
</style>
