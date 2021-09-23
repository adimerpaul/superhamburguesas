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
            <q-img :src="url+'/../imagenes/'+pedido.imagen" />
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
                  {{pedido.nombre}}
                </div>
                <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                  <q-icon name="place" />
                  {{pedido.precio}} Bs
                </div>
              </div>
              <q-rating v-model="stars" :max="5" size="32px" />
            </q-card-section>

            <q-card-section class="q-pt-none">
              <div class="text-subtitle1">
                {{pedido.precio}} Bs <template v-if="pedido.incluyes.length>0">・</template><template v-for="(inc,k) in pedido.incluyes" :key="k"> {{inc.nombre}} , </template>
              </div>
              <div class="text-caption text-grey">
                {{pedido.descripcion}}
              </div>
              <div>
                <ul>
                  <li v-for="(j,i) in jugos" :key="i">{{j.nombre}}</li>
                </ul>
              </div>
              <div>
                <ul>
                  <li v-for="(a,i) in agregados" :key="i">{{a.nombre}}</li>
                </ul>
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
          <q-btn flat label="OK" color="primary" v-close-popup />
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
      stars:5,
      rubros:[],
      modalpedido:false,
      pedido:{},
      fabRight:false,
      tab:1,
      jugos:[],
      agregados:[],
      url:process.env.API
    }
  },
  created() {
    this.$axios.get(process.env.API+'/rubro').then(res=>{
      // console.log(res.data)
      // this.rubros=res.data
      res.data.forEach(r=>{
        // console.log(r.productos.length)
        if (r.productos.length>0)
          this.rubros.push(r)
      })
    })
  },
  methods:{
    showpedido(p){
      this.pedido=p
      this.modalpedido=true
      this.$axios.get(process.env.API+'/combo/'+p.id).then(res=>{
        // console.log(res.data)
        res.data.forEach(r=>{
          console.log(r)
          if (r.tipo=='JUGO')
            this.jugos.push(r)
          if (r.tipo=='AGREGADO')
            this.agregados.push(r)
        })
        // console.log(this.dato2);
      })
    },
    onClick(){

    }
  }
}
</script>
<style lang="sass" scoped>
.my-card
  width: 100%
  //max-width: 300px
</style>
