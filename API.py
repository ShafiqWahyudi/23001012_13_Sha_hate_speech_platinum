from flask import Flask, jsonify
from flask import request
from flasgger import Swagger, LazyString, LazyJSONEncoder, swag_from
import pickle, re
import pandas as pd
import numpy as np
from tensorflow.keras.preprocessing.text import Tokenizer
from keras.models import load_model
from tensorflow.keras.preprocessing.sequence import pad_sequences

app = Flask(__name__)
app.json_encoder = LazyJSONEncoder
swagger_template = dict(
    info = {
        'title': LazyString(lambda:'API Documentation for Sentiment Analysis'),
        'version': LazyString(lambda:'1.0.0'),
        'description': LazyString(lambda: 'Dokumentasi API untuk Analisa Sentiment')
    },
    host = LazyString(lambda: request.host)
)
swagger_config = {
    'headers': [],
    'specs': [
        {
            'endpoint':'docs',
            'route': '/docs.json',
        }
    ],
    'static_url_path': '/flasgger_static',
    'swagger_ui': True,
    'specs_route': '/docs/'
}
swagger = Swagger(app, template=swagger_template, config=swagger_config)

max_features = 100000
tokenizer = Tokenizer(num_words=max_features, split=' ',lower=True)
sentiment = ['negative', 'neutral', 'positive']

def lowercase(tweet):
    return tweet.lower()

def clean_tweet(tweet):
    tweet = re.sub('[^0-9a-zA-Z]+', ' ', tweet)
    tweet = re.sub(r':', '', tweet)
    tweet = re.sub('\n',' ',tweet)
    tweet = re.sub('rt',' ', tweet)
    tweet = re.sub('((www\.[^\s]+)|(https?://[^\s]+)|(http?://[^\s]+))',' ', tweet)
    tweet = re.sub('  +', ' ', tweet)
    tweet = re.sub(r'pic.twitter.com.[\w]+', '', tweet)
    tweet = re.sub('user',' ', tweet)
    tweet = re.sub('gue','saya', tweet)
    tweet = re.sub(r'‚Ä¶', '', tweet)
    return tweet
    
def cleansing(text):
    clean_text = lowercase(text)
    clean_text = clean_tweet(clean_text)
    return clean_text

file_rnn = open('NN_R/x_pad_sequences.pickle','rb')
feature_file_from_rnn = pickle.load(file_rnn)
file_rnn.close()

file_lstm = open('LSTM_R/x_pad_sequences.pickle','rb')
feature_file_from_lstm = pickle.load(file_lstm)
file_rnn.close()

model_nn = load_model('NN_MODEL/NN.h5')
model_lstm = load_model('lstm_model/LSTM.h5')

@swag_from('C:/Users/User/Documents/data science/PLATINUM CHALLENGE/docs/rnn_text.yml',methods=['POST'])
@app.route('/rnn_text',methods=['POST'])
def rnn_text():

    original_text = request.form.get('text')

    text = [cleansing(original_text)]

    feature = tokenizer.texts_to_sequences(text)
    guess = pad_sequences(feature,maxlen=feature_file_from_rnn.shape[1])
    prediction = model_nn.predict(guess)
    get_sentiment = sentiment[np.argmax(prediction[0])]

    json_response = {
        'status_code': 200,
        'description': 'Result of Sentiment Analysis using RNN',
        'data': {
            'text': text,
            'sentiment': get_sentiment
        },
    }
    response_data = jsonify(json_response)
    return response_data

# Endpoint rnn file
@swag_from('C:/Users/User/Documents/data science/PLATINUM CHALLENGE/docs/rnn_file.yml',methods=['POST'])
@app.route('/rnn_file',methods=['POST'])
def rnn_file():
    file = request.files.get('file')
    df = pd.read_csv(file, encoding='latin-1')
    df['text_clean'] = df.apply(lambda row : cleansing(row['Tweet']), axis = 1)
    
    result = []

    for index, row in df.iterrows():
        text = tokenizer.texts_to_sequences([(row['text_clean'])])
        guess = pad_sequences(text, maxlen=feature_file_from_rnn.shape[1])
        prediction = model_nn.predict(guess)
        polarity = np.argmax(prediction[0])
        get_sentiment = sentiment[polarity]
        result.append(get_sentiment)

    original = df.text_clean.to_list()

    json_response = {
        'status_code' : 200,
        'description' : "Result of Sentiment Analysis using RNN",
        'data' : {
            'text' : original,
            'sentiment' : result
        },
    }
    response_data = jsonify(json_response)
    return response_data

@swag_from('C:/Users/User/Documents/data science/PLATINUM CHALLENGE/docs/LSTM_text.yml',methods=['POST'])
@app.route('/LSTM_text',methods=['POST'])
def lstm_text():

    original_text = request.form.get('text')

    text = [cleansing(original_text)]

    feature = tokenizer.texts_to_sequences(text)
    guess = pad_sequences(feature,maxlen=feature_file_from_lstm.shape[1])

    prediction = model_lstm.predict(guess)
    polarity = np.argmax(prediction[0])
    get_sentiment = sentiment[polarity]

    json_response = {
        'status_code': 200,
        'description': 'Result of Sentiment Analysis using LSTM',
        'data': {
            'text': text,
            'sentiment': get_sentiment
        },
    }
    response_data = jsonify(json_response)
    return response_data

# Endpoint LSTM file
@swag_from('C:/Users/User/Documents/data science/PLATINUM CHALLENGE/docs/LSTM_file.yml',methods=['POST'])
@app.route('/LSTM_file',methods=['POST'])
def lstm_file():
    file = request.files.get('file')
    df = pd.read_csv(file, encoding='latin-1')
    df['text_clean'] = df.apply(lambda row : cleansing(row['Tweet']), axis = 1)
    
    result = []

    for index, row in df.iterrows():
        text = tokenizer.texts_to_sequences([(row['text_clean'])])
        guess = pad_sequences(text, maxlen=feature_file_from_lstm.shape[1])
        prediction = model_lstm.predict(guess)
        polarity = np.argmax(prediction[0])
        get_sentiment = sentiment[polarity]
        result.append(get_sentiment)

    original = df.text_clean.to_list()

    json_response = {
        'status_code' : 200,
        'description' : "Result of Sentiment Analysis using LSTM",
        'data' : {
            'text' : original,
            'sentiment' : result
        },
    }
    response_data = jsonify(json_response)
    return response_data


if __name__ == '__main__':
    app.run()
    
