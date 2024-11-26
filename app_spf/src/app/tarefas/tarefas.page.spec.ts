import { ComponentFixture, TestBed } from '@angular/core/testing';
import { TarefasPage } from './tarefas.page';

describe('TarefasPage', () => {
  let component: TarefasPage;
  let fixture: ComponentFixture<TarefasPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(TarefasPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
