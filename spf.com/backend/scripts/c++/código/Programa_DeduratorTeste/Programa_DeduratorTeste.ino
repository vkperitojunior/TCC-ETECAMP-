/*
  Projeto: Dedurator SPF (Versão Simplificada)
  Descrição: Sistema de controle de 2 botões e 2 LEDs com música em um ESP32 WROOM.
*/

#include <Arduino.h>

// Definições dos pinos
const int pinosBotoes[] = {21, 22}; // Pinos dos botões (GPIO21 e GPIO22)
const int pinosLeds[] = {19, 23};   // Pinos dos LEDs correspondentes aos botões
const int pinoBuzzer = 18;          // Pino do buzzer
const int pinoLedmemoria = 5;          // Pino do led de memoria

// Cores correspondentes aos botões
const char* cores[] = {"Vermelho", "Azul"};

// Frequências das músicas
const int melodia1[] = {262, 294, 330, 349, 392, 440, 494, 523}; // Música 1
const int melodia2[] = {523, 494, 440, 392, 349, 330, 294, 262}; // Música 2
const int melodiaInicial[] = {523, 587, 659, 698, 784}; // Música de inicialização
const int duracaoNota = 500; // Duração das notas

// Variáveis para verificação de botão
int estadoAnterior[] = {HIGH, HIGH}; // Estado anterior dos pinos de entrada
int estadoAtual[] = {HIGH, HIGH};    // Leitura atual dos pinos de entrada

void setup() {
  Serial.begin(115200);

  // Inicializa os pinos dos botões como entrada com pull-up interno
  pinMode(pinosBotoes[0], INPUT_PULLUP);
  pinMode(pinosBotoes[1], INPUT_PULLUP);

  // Inicializa os pinos dos LEDs como saída
  pinMode(pinosLeds[0], OUTPUT);
  pinMode(pinosLeds[1], OUTPUT);

  // Inicializa o pino do buzzer como saída
  pinMode(pinoBuzzer, OUTPUT);

  // Inicializa o pino do led de memoria como saída
  pinMode(pinoLedmemoria, OUTPUT);

  // Toca a música de inicialização
  tocarMelodia(melodiaInicial, sizeof(melodiaInicial) / sizeof(int));
}

void loop() {
  // Verifica estado do botão 1
  estadoAtual[0] = digitalRead(pinosBotoes[0]);
  if (estadoAnterior[0] == LOW && estadoAtual[0] == HIGH) {
    // Botão 1 pressionado
    Serial.println("Botão 1 pressionado - Cor: Vermelho - LED: 19");

    // Acende LED correspondente ao botão 1
    digitalWrite(pinosLeds[0], HIGH);

    // Toca a primeira música
    tocarMelodia(melodia1, sizeof(melodia1) / sizeof(int));

    // Contagem de 10 segundos
    for (int i = 1; i <= 10; i++) {
      Serial.print("Contando: ");
      Serial.println(i);
    // Acende LED correspondente a memoria
      digitalWrite(pinoLedmemoria, HIGH);
        delay(500); // Espera 1 segundo
      digitalWrite(pinoLedmemoria, LOW);
          digitalWrite(pinoLedmemoria, HIGH);
        delay(500); // Espera 1 segundo
      digitalWrite(pinoLedmemoria, LOW);
      delay(1000); // Espera 1 segundo
    // Acende LED correspondente a memoria

    }

    // Toca a segunda música
    tocarMelodia(melodia2, sizeof(melodia2) / sizeof(int));

    // Apaga LED correspondente ao botão 1
    digitalWrite(pinosLeds[0], LOW);

// aviso de fim da contagem da chance de resposta
        Serial.println("Fim de chance");
  }

  // Verifica estado do botão 2
  estadoAtual[1] = digitalRead(pinosBotoes[1]);
  if (estadoAnterior[1] == LOW && estadoAtual[1] == HIGH) {
    // Botão 2 pressionado
    Serial.println("Botão 2 pressionado - Cor: Azul - LED: 23");

    // Acende LED correspondente ao botão 2
    digitalWrite(pinosLeds[1], HIGH);

    // Toca a primeira música
    tocarMelodia(melodia1, sizeof(melodia1) / sizeof(int));

    // Contagem de 10 segundos
    for (int i = 1; i <= 10; i++) {
      Serial.print("Contando: ");
      Serial.println(i);
    // Acende LED correspondente a memoria
      digitalWrite(pinoLedmemoria, HIGH);
        delay(500); // Espera 1 segundo
      digitalWrite(pinoLedmemoria, LOW);
          digitalWrite(pinoLedmemoria, HIGH);
        delay(500); // Espera 1 segundo
      digitalWrite(pinoLedmemoria, LOW);
      delay(1000); // Espera 1 segundo
    // Acende LED correspondente a memoria
    }

    // Toca a segunda música
    tocarMelodia(melodia2, sizeof(melodia2) / sizeof(int));

    // Apaga LED correspondente ao botão 2
    digitalWrite(pinosLeds[1], LOW);

    
// aviso de fim da contagem da chance de resposta
        Serial.println("Fim de chance");
  }

  // Atualiza o estado anterior dos botões
  estadoAnterior[0] = estadoAtual[0];
  estadoAnterior[1] = estadoAtual[1];
}

// Função para tocar uma melodia
void tocarMelodia(const int *melodia, int tamanho) {
  for (int i = 0; i < tamanho; i++) {
    tone(pinoBuzzer, melodia[i], duracaoNota);
    delay(duracaoNota * 1.30);
    noTone(pinoBuzzer);
  }
}

// Copyright (c) 2024, Vinicius Kum
