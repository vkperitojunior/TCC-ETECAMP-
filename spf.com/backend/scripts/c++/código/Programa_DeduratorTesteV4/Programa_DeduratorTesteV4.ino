/*
  Projeto: Dedurator SPF (Versão com 4 botões)
  Descrição: Sistema de controle de 4 botões e 4 LEDs com música em um ESP32 WROOM.
  Faça o esp se resetar após a execução do código de um dos botões, use debounce ou uso o time para ver a diferença
*/

#include <Arduino.h>

// Definições dos pinos
const int pinosBotoes[] = {21, 22, 25, 26}; // Pinos dos botões (GPIO21, GPIO22, GPIO25, GPIO26)
const int pinosLeds[] = {19, 23, 4, 14};   // Pinos dos LEDs correspondentes aos botões
const int pinoBuzzer = 18;                 // Pino do buzzer
const int pinoLedmemoria = 5;              // Pino do led de memoria

// Cores correspondentes aos botões
const char* cores[] = {"Vermelho", "Azul", "Verde", "Amarelo"};

// Frequências das músicas
const int melodia1[] = {262, 294, 330, 349, 392, 440, 494, 523}; // Música 1
const int melodia2[] = {523, 494, 440, 392, 349, 330, 294, 262}; // Música 2
const int melodiaInicial[] = {523, 587, 659, 698, 784};          // Música de inicialização
const int duracaoNota = 500; // Duração das notas

// Variáveis para verificação de botão
int estadoAnterior[] = {HIGH, HIGH, HIGH, HIGH}; // Estado anterior dos pinos de entrada
int estadoAtual[] = {HIGH, HIGH, HIGH, HIGH};    // Leitura atual dos pinos de entrada
bool emExecucao = false; // Variável de trava para impedir múltiplas execuções

// Controle de debounce
unsigned long ultimoTempoBotao[] = {0, 0, 0, 0};  // Tempo da última leitura válida para cada botão
const unsigned long debounceDelay = 50;           // Delay de debounce (50 ms)

void setup() {
  Serial.begin(115200);

  Serial.println("Definindo os pinos:");
  // Inicializa os pinos dos botões como entrada com pull-up interno
  for (int i = 0; i < 4; i++) {
    pinMode(pinosBotoes[i], INPUT_PULLUP);
  }

  // Inicializa os pinos dos LEDs como saída
  for (int i = 0; i < 4; i++) {
    pinMode(pinosLeds[i],
OUTPUT);
  }

  // Inicializa o pino do buzzer como saída
  pinMode(pinoBuzzer, OUTPUT);

  // Inicializa o pino do led de memória como saída
  pinMode(pinoLedmemoria, OUTPUT);

  Serial.println("Inicio do programa");
  // Toca a música de inicialização
  tocarMelodia(melodiaInicial, sizeof(melodiaInicial) / sizeof(int));
}

void loop() {
  // Se já está executando uma ação, não verifica novos botões
  if (emExecucao) {
    return;
  }

  for (int i = 0; i < 4; i++) {
    estadoAtual[i] = digitalRead(pinosBotoes[i]);
    unsigned long tempoAtual = millis();

    // Verifica se o botão foi pressionado e se passou o tempo do debounce
    if (estadoAnterior[i] == LOW && estadoAtual[i] == HIGH && (tempoAtual - ultimoTempoBotao[i]) > debounceDelay) {
      // Atualiza o último tempo de leitura válido para o botão atual
      ultimoTempoBotao[i] = tempoAtual;

      // Ativa a trava
      emExecucao = true;

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

      // Desativa a trava após a execução
      emExecucao = false;
    }
    estadoAnterior[i] = estadoAtual[i]; // Atualiza o estado anterior dos botões
  }
}

// Função para tocar uma melodia
void tocarMelodia(const int *melodia, int tamanho) {
  Serial.println("Tocando música");
  for (int i = 0; i < tamanho; i++) {
    tone(pinoBuzzer, melodia[i], duracaoNota);
    delay(duracaoNota * 1.30);
    noTone(pinoBuzzer);
  }
}

// Copyright (c) 2024, Vinicius Kum
