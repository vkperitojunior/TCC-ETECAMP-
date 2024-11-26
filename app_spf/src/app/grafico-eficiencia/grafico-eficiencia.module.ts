import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { GraficoEficienciaPageRoutingModule } from './grafico-eficiencia-routing.module';

import { GraficoEficienciaPage } from './grafico-eficiencia.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    GraficoEficienciaPageRoutingModule
  ],
  declarations: [GraficoEficienciaPage]
})
export class GraficoEficienciaPageModule {}
