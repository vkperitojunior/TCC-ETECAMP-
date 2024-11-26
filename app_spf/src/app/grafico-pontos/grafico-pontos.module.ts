import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { GraficoPontosPageRoutingModule } from './grafico-pontos-routing.module';

import { GraficoPontosPage } from './grafico-pontos.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    GraficoPontosPageRoutingModule
  ],
  declarations: [GraficoPontosPage]
})
export class GraficoPontosPageModule {}
