<template>
  <q-page class="q-pa-md">
    <div class="row">
      <div class="col-12 col-md-2"></div>
      <div class="col-12 col-md-8">
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
            <q-tab name="login" label="Ingresar" />
            <q-tab name="registro" label="Registrarse" />
<!--            <q-tab name="movies" label="Movies" />-->
          </q-tabs>
          <q-separator />
          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="login">
              <div class="text-h6">Ingresar al sistemas</div>
              Por favor colocar Tu celular y contraseña
              <q-form>
                <div class="row">
                  <div class="col-12">
<!--                    color="purple-12"-->
                    <q-input outlined v-model="celular" label="Celular*" hint="Porfavor ingresar celular">
                      <template v-slot:prepend>
                        <q-icon name="phone" />
                      </template>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <!--                    color="purple-12"-->
                    <q-input outlined v-model="password" label="Password*" :type="isPwd ? 'password' : 'text'" hint="Porfavor ingresar contraseña">
                      <template v-slot:prepend>
                        <q-icon name="lock" />
                      </template>
                      <template v-slot:append>
                        <q-icon
                          :name="isPwd ? 'visibility_off' : 'visibility'"
                          class="cursor-pointer"
                          @click="isPwd = !isPwd"
                        />
                      </template>
                    </q-input>
                  </div>
                  <div class="col-12 q-py-md">
                    <q-btn label="INGRESAR" color="primary" icon="login" class="full-width"/>
                    <q-btn label="Registrate" color="secondary" icon="how_to_reg" @click="tab='registro'" class="full-width q-mt-xs" />
                    <div class="text-caption q-py-xs">
                      <a href="#">Olvidate tu contraseña?</a>
                    </div>

                  </div>
                </div>
              </q-form>
            </q-tab-panel>

            <q-tab-panel name="registro">
              <div class="text-h6">Registrate </div>
              podras realizar tu pedidos
              <q-form>
                <div class="row">
                  <div class="col-12">
                    <!--                    color="purple-12"-->
                    <q-input outlined v-model="user.email" label="Email*" hint="Porfavor ingresar email">
                      <template v-slot:prepend>
                        <q-icon name="email" />
                      </template>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <q-input outlined v-model="user.celular" label="Celular*" hint="Porfavor ingresar celular">
                      <template v-slot:prepend>
                        <q-icon name="phone" />
                      </template>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <q-input outlined v-model="user.cinit" label="Carnet o NIT*" hint="Porfavor ingresar carnet o nit">
                      <template v-slot:prepend>
                        <q-icon name="credit_card" />
                      </template>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <l-map ref="map" style="height:50vh" v-model:zoom="zoom" :center="[44.48865, 11.3317]">
                      <l-tile-layer
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                        layer-type="base"
                        name="OpenStreetMap"
                      ></l-tile-layer>
                      <l-circle :lat-lng="[44.48865, 11.3317]" :radius="5000" color="green" />
                    </l-map>
                  </div>
                  <div class="col-12">
                    <q-input outlined v-model="user.password" label="Password*" :type="isPwd ? 'password' : 'text'" hint="Porfavor ingresar contraseña">
                      <template v-slot:prepend>
                        <q-icon name="lock" />
                      </template>
                      <template v-slot:append>
                        <q-icon
                          :name="isPwd ? 'visibility_off' : 'visibility'"
                          class="cursor-pointer"
                          @click="isPwd = !isPwd"
                        />
                      </template>
                    </q-input>
                  </div>
                  <div class="col-12 q-py-md">
                    <q-btn label="INGRESAR" color="primary" icon="login" class="full-width"/>
                    <q-btn label="Registrate" color="secondary" icon="how_to_reg" @click="tab='registro'" class="full-width q-mt-xs" />
                    <div class="text-caption q-py-xs">
                      <a href="#">Olvidate tu contraseña?</a>
                    </div>

                  </div>
                </div>
              </q-form>
            </q-tab-panel>

<!--            <q-tab-panel name="movies">-->
<!--              <div class="text-h6">Movies</div>-->
<!--              Lorem ipsum dolor sit amet consectetur adipisicing elit.-->
<!--            </q-tab-panel>-->
          </q-tab-panels>
        </q-card>

<!--        <q-card class="">-->
<!--          <q-card-section class="bg-secondary text-white">-->
<!--            <div class="text-h6">-->
<!--              <q-icon name="login" />-->
<!--              Ingreso al sistemas-->
<!--            </div>-->
<!--            <div class="text-subtitle2">-->
<!--              <a href="">Olvide mi contraseña</a>-->
<!--            </div>-->
<!--          </q-card-section>-->
<!--          <q-card-section>-->
<!--            <q-form-->
<!--              @submit="login"-->
<!--              @reset="onReset"-->
<!--              class="q-gutter-md"-->
<!--            >-->
<!--              <q-input-->
<!--                filled-->
<!--                v-model="celular"-->
<!--                label="Ingresa tu celular *"-->
<!--                hint="Email de ingreso"-->
<!--                lazy-rules-->
<!--                type="number"-->
<!--                :rules="[ val => val && val.length > 0 || 'Porfavor ingresar dato']"-->
<!--              />-->
<!--              <q-input-->
<!--                autocomplete="on"-->
<!--                type="password"-->
<!--                filled-->
<!--                v-model="password"-->
<!--                label="Password *"-->
<!--                hint="Contraseña "-->
<!--                lazy-rules-->
<!--                :rules="[ val => val && val.length > 0 || 'Porfavor ingresar dato']"-->
<!--              />-->

<!--              &lt;!&ndash;              <q-input&ndash;&gt;-->
<!--              &lt;!&ndash;                filled&ndash;&gt;-->
<!--              &lt;!&ndash;                type="number"&ndash;&gt;-->
<!--              &lt;!&ndash;                v-model="age"&ndash;&gt;-->
<!--              &lt;!&ndash;                label="Your age *"&ndash;&gt;-->
<!--              &lt;!&ndash;                lazy-rules&ndash;&gt;-->
<!--              &lt;!&ndash;                :rules="[&ndash;&gt;-->
<!--              &lt;!&ndash;          val => val !== null && val !== '' || 'Please type your age',&ndash;&gt;-->
<!--              &lt;!&ndash;          val => val > 0 && val < 100 || 'Please type a real age'&ndash;&gt;-->
<!--              &lt;!&ndash;        ]"&ndash;&gt;-->
<!--              &lt;!&ndash;              />&ndash;&gt;-->
<!--              &lt;!&ndash;              <q-toggle v-model="accept" label="I accept the license and terms" />&ndash;&gt;-->
<!--              <div>-->
<!--                <q-btn label="Ingresar" type="submit" icon="login" color="positive"/>-->
<!--                <q-btn label="Reset" type="reset" icon="restart_alt" color="negative" class="q-ml-sm" />-->
<!--              </div>-->
<!--            </q-form>-->

<!--          </q-card-section>-->
<!--          <q-separator dark />-->
<!--          &lt;!&ndash;          <q-card-actions>&ndash;&gt;-->
<!--          &lt;!&ndash;            <q-btn flat>Action 1</q-btn>&ndash;&gt;-->
<!--          &lt;!&ndash;            <q-btn flat>Action 2</q-btn>&ndash;&gt;-->
<!--          &lt;!&ndash;          </q-card-actions>&ndash;&gt;-->
<!--        </q-card>-->
      </div>
      <div class="col-12 col-md-2">

      </div>
    </div>
  </q-page>
  <!--  <div>-->
  <!--    <form class="login" @submit.prevent="login">-->
  <!--      <h1>Sign in</h1>-->
  <!--      <label>Email</label>-->
  <!--      <input required v-model="celular" type="celular" placeholder="Name"/>-->
  <!--      <label>Password</label>-->
  <!--      <input required v-model="password" type="password" placeholder="Password"/>-->
  <!--      <hr/>-->
  <!--      <button type="submit">Login</button>-->
  <!--    </form>-->
  <!--  </div>-->
</template>

<script>

// import { defineComponent, ref } from 'vue'
// import { useQuasar } from 'quasar'
// import { useStore } from 'vuex'
// import { useRouter } from 'vue-router'
// import L from 'leaflet';
// import { LMap, LTileLayer, LMarker, LGeoJson } from 'vue2-leaflet';

// import { LMap, LTileLayer } from 'vue2-leaflet'
// import L from 'leaflet'
// import 'leaflet/dist/leaflet.css'
import "leaflet/dist/leaflet.css"
import { LMap, LTileLayer, LCircle }from "@vue-leaflet/vue-leaflet";

export default {
  name: 'MainLayout',
  components: {
    LMap,
    LTileLayer,
    LCircle,
  },
  data(){
    return{
      geojson: {
        type: "FeatureCollection",
        features: [
          // ...
        ],
      },
      geojsonOptions: {
        // Options that don't rely on Leaflet methods.
      },
      zoom:11,
      celular:'69603027',
      password:'admin',
      tab:'registro',
      user:{},
      isPwd:true,
    }
  },
  async beforeMount() {
    // HERE is where to load Leaflet components!
    const { circleMarker } = await import("leaflet/dist/leaflet-src.esm");

    // And now the Leaflet circleMarker function can be used by the options:
    this.geojsonOptions.pointToLayer = (feature, latLng) =>
      circleMarker(latLng, { radius: 8 });
    this.mapIsReady = true;
  },
  mounted() {
    // console.log(this.center)
  }
  // setup () {
  //   const $store = useStore()
  //   const $q = useQuasar()
  //   const $router = useRouter()
  //   const celular = ref("69603027")
  //   const password = ref("admin")
  //   return {
  //     tab: ref('registro'),
  //     isPwd: ref(true),
  //     celular,
  //     password,
  //     login () {
  //       $q.loading.show()
  //       // let celular = this.celular
  //       // let password = this.password
  //       // console.log(celular.value)
  //       $store.dispatch('showcase/login', { celular:celular.value, password:password.value })
  //         .then(() =>{
  //           $q.loading.hide()
  //           $router.push('/')
  //         })
  //         .catch(err => {
  //           $q.loading.hide();
  //           // console.log(err)
  //           $q.notify({
  //             message:err,
  //             color:'red',
  //             icon:'error'
  //           })
  //         })
  //     },
  //     onReset(){
  //       this.celular=null;
  //       this.password=null;
  //     }
  //   }
  // }
}

// export default {
//   data(){
//     return {
//       celular : "admin@test.com",
//       password : "admin"
//     }
//   },
//   methods: {
//     login: function () {
//       this.$q.loading.show()
//       let celular = this.celular
//       let password = this.password
//       this.$store.dispatch('login', { celular, password })
//         .then(() =>{
//           this.$q.loading.hide()
//           this.$router.push('/')
//         })
//         .catch(err => {
//           this.$q.loading.hide();
//           // console.log(err.response.data)
//           this.$q.notify({
//             message:err.response.data.res,
//             color:'red',
//             icon:'error'
//           })
//         })
//     },
//     onReset(){
//       this.celular=null;
//       this.password=null;
//     }
//   },
// }
</script>

<style scoped>
</style>
