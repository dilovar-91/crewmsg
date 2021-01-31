<template>
  <div>
    <Hero />
    <OurServices />
    <Features />
    <ProFeatures />
    <ContactUs />
    <KeepInTouch />
    <Info />
  </div>
</template>

<script>
import Hero from '@/pages/sections/Hero'
import OurServices from '@/pages/sections/OurServices'
import Features from '@/pages/sections/Features'
import ContactUs from '@/pages/sections/ContactUs'
import KeepInTouch from '@/pages/sections/KeepInTouch'
import ProFeatures from '@/pages/sections/ProFeatures'
import Info from '@/pages/sections/Info'

export default {
  name: 'Home',
  layout: 'home',
  components: {
    Hero,
    OurServices,
    Features,
    ContactUs,
    KeepInTouch,
    ProFeatures,
    Info
  }
}
</script>
