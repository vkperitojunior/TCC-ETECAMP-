/*
  Projeto: Dedurator SPF (Versão com 10 botões)
  Descrição: Sistema de controle de 10 botões e 10 LEDs com música em um ESP32 WROOM.
*/

#include <Arduino.h>

// Definições dos pinos
const int pinosBotoes[] = {21, 22, 25, 26, 32, 33, 34, 35, 36, 39}; // Pinos dos botões (GPIO21, GPIO22, GPIO25, GPIO26, etc.)
const int pinosLeds[] = {19, 23, 4, 14, 13, 12, 27, 16, 17, 18};    // Pinos dos LEDs correspondentes aos botões
const int pinoBuzzer = 18;                                          // Pino do buzzer
const int pinoLedmemoria = 5;                                       // Pino do led de memoria

// Cores correspondentes aos botões
const char* cores[] = {"Vermelho", "Azul", "Verde", "Amarelo", "Roxo", "Laranja", "Ciano", "Rosa", "Branco", "Preto"};

// Frequências das músicas
const int melodia1[] = {262, 294, 330, 349, 392, 440, 494, 523};    // Música 1
const int melodia2[] = {523, 494, 440, 392, 349, 330, 294, 262};    // Música 2
const int melodiaInicial[] = {523, 587, 659, 698, 784};             // Música de inicialização
const int duracaoNota = 500;                                        // Duração das notas

// Variáveis para verificação de botão
int estadoAnterior[] = {HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH}; // Estado anterior dos pinos de entrada
int estadoAtual[] = {HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH, HIGH};    // Leitura atual dos pinos de entrada

void setup() {
  Serial.begin(115200);

  Serial.println("Definindo os pinos:");
  // Inicializa os pinos dos botões como entrada com pull-up interno
  for (int i = 0; i < 10; i++) {
    pinMode(pinosBotoes[i], INPUT_PULLUP);
  }

  // Inicializa os pinos dos LEDs como saída
  for (int i = 0; i < 10; i++) {
    pinMode(pinosLeds[i], OUTPUT);
  }

  // Inicializa o pino do buzzer como saída
  pinMode(pinoBuzzer, OUTPUT);

  // Inicializa o pino do led de memoria como saída
  pinMode(pinoLedmemoria, OUTPUT);

  Serial.println("Inicio do programa");
  // Toca a música de inicialização
  tocarMelodia(melodiaInicial, sizeof(melodiaInicial) / sizeof(int));
}

void loop() {
  for (int i = 0; i < 10; i++) {
    estadoAtual[i] = digitalRead(pinosBotoes[i]);
    if (estadoAnterior[i] == LOW && estadoAtual[i] == HIGH) {
      // Botão pressionado
      Serial.printf("Botão %d pressionado - Cor: %s - LED: %d\n", i + 1, cores[i], pinosLeds[i]);

      // Acende LED correspondente ao botão
      digitalWrite(pinosLeds[i], HIGH);

      // Toca a primeira música
      tocarMelodia(melodia1, sizeof(melodia1) / sizeof(int));

      // Contagem de 10 segundos com o LED de memória piscando
      for (int j = 1; j <= 10; j++) {
        Serial.print("Contando: ");
        Serial.println(j);
        digitalWrite(pinoLedmemoria, HIGH);
        delay(500);
        digitalWrite(pinoLedmemoria, LOW);
        delay(500);
      }

      // Toca a segunda música
      tocarMelodia(melodia2, sizeof(melodia2) / sizeof(int));

      // Apaga LED correspondente ao botão
      digitalWrite(pinosLeds[i], LOW);

      // Aviso de fim da contagem da chance de resposta
      Serial.println("Fim de chance");

      // Retorna ao início do loop para garantir que nenhum outro botão seja processado
      break;
    }
    estadoAnterior[i] = estadoAtual[i]; // Atualiza o estado anterior dos botões
  }
}

// Função para tocar uma melodia
void tocarMelodia(const int *melodia, int tamanho) {
  Serial.println("Musica de Fim");
  for (int i = 0; i < tamanho; i++) {
    tone(pinoBuzzer, melodia[i], duracaoNota);
    delay(duracaoNota * 1.30);
    noTone(pinoBuzzer);
  }
}

// Copyright (c) 2024, Vinicius Kum
