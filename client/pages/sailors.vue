<template>
  <div>
    <Hero />
    <OurServices />
    <Features />
    <ProFeatures />
    <ContactUs />
    <Affiliates />
    <SocialMedia />
    <KeepInTouch />
    <Newsletter />

    <Info />
  </div>
</template>

<script>
import Hero from '@/pages/sections/Hero'
import OurServices from '@/pages/sections/OurServices'
import Features from '@/pages/sections/Features'
import ContactUs from '@/pages/sections/ContactUs'
import Affiliates from '@/pages/sections/Affiliates'
import SocialMedia from '@/pages/sections/SocialMedia'
import KeepInTouch from '@/pages/sections/KeepInTouch'
import Newsletter from '@/pages/sections/Newsletter'
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
    Affiliates,
    SocialMedia,
    KeepInTouch,
    Newsletter,
    ProFeatures,
    Info
  }
}
</script>
