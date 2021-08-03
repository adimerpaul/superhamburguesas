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
  }
}
</script>

<style lang="sass" scoped>
.my-card
  width: 100%
  max-width: 350px
</style>
