<template>
  <div class="q-pa-md">
    <div class="row">
      <div class="col-12">
        <div class="flex justify-between">
          <div class="text-bold text-h4">Mi pedido</div>
          <div class="text-bold text-h4">{{total}} Bs</div>
        </div>
        <q-separator />
      </div>
      <div class="col-12">
          <table style="width: 100%">
            <tr v-for="(p,i) in $store.state.showcase.mipedido" :key="i">
              <td> <div class="text-bold text-h6">{{p.nombre}} <q-badge  v-for="(s,j) in p.subdetalle" :key="j" align="top">{{s.nombre}}</q-badge> </div> </td>
              <td style="text-align: right"><div class="text-bold text-h6">Cant. {{p.cantidad}}</div></td>
              <td style="text-align: right"><div class="text-bold text-h6"> {{p.subtotal}} Bs <q-btn flat icon="delete_outline" @click="borrar(j)" color="negative" /></div></td>
            </tr>
          </table>
<!--        {{ $store.state.showcase.mipedido}}-->
        <q-separator />
      </div>
      <div class="col-12">
        <div class="flex justify-start">
          <div class="text-bold text-h4">Datos Cliente</div>
          <div class="text-bold text-h4"></div>
        </div>
        <q-separator />
      </div>
      <div class="col-12">
        <q-form @submit.prevent="update">
          <div class="row">
            <div class="col-12">
              <!--                    color="purple-12"-->
              <q-input outlined v-model="cliente.email" label="Email*" hint="Porfavor ingresar email" :rules="rule" disable>
                <template v-slot:prepend>
                  <q-icon name="email" />
                </template>
              </q-input>
            </div>
            <div class="col-12">
              <q-input outlined v-model="cliente.telefono" label="Celular*" hint="Porfavor ingresar celular" :rules="rule" disable>
                <template v-slot:prepend>
                  <q-icon name="phone" />
                </template>
              </q-input>
            </div>
            <div class="col-12">
              <q-input outlined v-model="cliente.cinit" label="Carnet o NIT*" hint="Porfavor ingresar carnet o nit" :rules="rule">
                <template v-slot:prepend>
                  <q-icon name="credit_card" />
                </template>
              </q-input>
            </div>
            <div class="col-12">
              <q-input outlined v-model="cliente.nombre" label="Nombre completo*" hint="Porfavor ingresar nombre completo" :rules="rule">
                <template v-slot:prepend>
                  <q-icon name="people" />
                </template>
              </q-input>
            </div>
            <div class="col-12">
              <q-input outlined v-model="cliente.direccion" label="Direccion*" hint="Direccion de donde quires el pedido" :rules="rule">
                <template v-slot:prepend>
                  <q-icon name="home" />
                </template>
              </q-input>
            </div>
            <div class="col-12">
              <div style="height: 35vh;">
<!--                @locationfound="onLocationFound"-->
                <l-map
                  @ready="onReady"

                  v-model="zoom"
                  v-model:zoom="zoom"
                  :center="center"
                  @click="ubicacion"

                >
                  <!--                        @move="log('move')"-->
                  <l-tile-layer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                  ></l-tile-layer>
                  <l-control-layers />
                  <!--                        <l-marker :lat-lng="[0, 0]" draggable @moveend="log('moveend')">-->
                  <!--                          <l-tooltip>-->
                  <!--                            lol-->
                  <!--                          </l-tooltip>-->
                  <!--                        </l-marker>-->

                  <!--                        <l-marker :lat-lng="[47.41322, -1.219482]">-->
                  <!--                          <l-icon :icon-url="iconUrl" :icon-size="iconSize" />-->
                  <!--                        </l-marker>-->

                  <l-marker :lat-lng="center" draggable @moveend="log">
                    <l-popup>
                      lol
                    </l-popup>
                  </l-marker>

                  <!--                        <l-polyline-->
                  <!--                          :lat-lngs="[-->
                  <!--          [47.334852, -1.509485],-->
                  <!--          [47.342596, -1.328731],-->
                  <!--          [47.241487, -1.190568],-->
                  <!--          [47.234787, -1.358337],-->
                  <!--        ]"-->
                  <!--                          color="green"-->
                  <!--                        ></l-polyline>-->
                  <!--                        <l-polygon-->
                  <!--                          :lat-lngs="[-->
                  <!--          [46.334852, -1.509485],-->
                  <!--          [46.342596, -1.328731],-->
                  <!--          [46.241487, -1.190568],-->
                  <!--          [46.234787, -1.358337],-->
                  <!--        ]"-->
                  <!--                          color="#41b782"-->
                  <!--                          :fill="true"-->
                  <!--                          :fillOpacity="0.5"-->
                  <!--                          fillColor="#41b782"-->
                  <!--                        />-->
                  <!--                        <l-rectangle-->
                  <!--                          :lat-lngs="[-->
                  <!--          [46.334852, -1.509485],-->
                  <!--          [46.342596, -1.328731],-->
                  <!--          [46.241487, -1.190568],-->
                  <!--          [46.234787, -1.358337],-->
                  <!--        ]"-->
                  <!--                          :fill="true"-->
                  <!--                          color="#35495d"-->
                  <!--                        />-->
                  <!--                        <l-rectangle-->
                  <!--                          :bounds="[-->
                  <!--          [46.334852, -1.190568],-->
                  <!--          [46.241487, -1.090357],-->
                  <!--        ]"-->
                  <!--                        >-->
                  <!--                          <l-popup>-->
                  <!--                            lol-->
                  <!--                          </l-popup>-->
                  <!--                        </l-rectangle>-->
                </l-map>
                <!--                      <button @click.prevent="changeIcon">New kitten icon</button>-->

              </div>
            </div>

            <div class="col-12 q-py-md">
              <q-btn label="Enviar mi pedido" color="accent" icon="login" class="full-width" type="submit"/>
<!--              <q-btn label="Ingresa" color="secondary" icon="how_to_reg" @click="tab='login'" class="full-width q-mt-xs" />-->
<!--              <div class="text-caption q-py-xs">-->
<!--                <a href="#">Olvidate tu contraseña?</a>-->
<!--              </div>-->
            </div>
          </div>
        </q-form>

      </div>
    </div>
  </div>
</template>

<script>
import {
  LMap,
  LIcon,
  LTileLayer,
  LMarker,
  LControlLayers,
  LTooltip,
  LPopup,
  LPolyline,
  LPolygon,
  LRectangle,
} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";

export default {
  components: {
    LMap,
    // LIcon,
    LTileLayer,
    LMarker,
    LControlLayers,
    // LTooltip,
    LPopup,
    // LPolyline,
    // LPolygon,
    // LRectangle,
  },
  data () {
    return {
      cliente:{},
      rule:[
        val => (val && val.length > 0) || 'Porfavor ingresar dato'
      ],
      zoom: 14,
      center:[-17.970371, -67.112303],
    }
  },
  created() {
    this.$q.loading.show()
    this.$axios.get(process.env.API+'/cliente').then(res=>{
      // console.log(res.data)
      this.$q.loading.hide()
      this.cliente=res.data
      this.cliente.email=this.$store.state.showcase.user.email
      this.center=[res.data.lat, res.data.lng]
    })
  },
  methods:{
    borrar(i){
      this.$store.dispatch("showcase/borrar",i)
    },
    update(){
      if (this.$store.state.showcase.mipedido.length==0){
        this.$q.notify({
          message:'Debes Selecionar productos para tu pedido',
          color:'red',
          icon:'error'
        })
        return false
      }
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/pedido',{
        cliente:this.cliente,
        total:this.total,
        detalles:this.$store.state.showcase.mipedido
      }).then(res=>{
        this.$q.loading.hide()
        this.$q.notify({
          message:'Su pedioo fue enviado',
          color:'green',
          icon:'shop'
        })
        this.$store.dispatch("showcase/limpiar")
        // console.log(res.data)
        // this.cliente=res.data
        // this.cliente.email=this.$store.state.showcase.user.email
        // this.center=[res.data.lat, res.data.lng]
      })
    },
    ubicacion(e){
      // console.log(e.latlng)
      if (e.latlng!=undefined){
        this.center=[e.latlng.lat,e.latlng.lng]
        this.cliente.lat=e.latlng.lat
        this.cliente.lng=e.latlng.lng
      }

    },
    onReady (mapObject) {
      mapObject.locate();
    },
    // onLocationFound(location){
    //   // console.log(location)
    //   let radius = location.accuracy / 2
    //   // console.log( radius	)
    //   this.center=[location.latlng.lat,location.latlng.lng]
    // },
    log(a) {
      // console.log(a.target._lastCenter.lat)
      // console.log(a)
      // console.log(a.target._latlng);
      this.center=[a.target._latlng.lat,a.target._latlng.lng]
      // console.log(this.center)
    },
  },
  computed:{
    total(){
      let t=0
      this.$store.state.showcase.mipedido.forEach(r=>{
        // console.log(r)
        t+=r.subtotal
      })
      return t;
    }
  }
}
</script>
