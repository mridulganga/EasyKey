from flask import Flask, g, render_template, request, redirect
import pyrebase

config = {
  "apiKey": "AIzaSyDsoYLse6FrkbClDm-C0BoLg_m7U0yyBps",
  "authDomain": "easykey-160212.firebaseapp.com",
  "databaseURL": "https://easykey-160212.firebaseio.com",
  "storageBucket": "easykey-160212.appspot.com"
}
app = Flask(__name__)
firebase = pyrebase.initialize_app(config)
db = firebase.database()

def add_firebase_entry(source,uid):
    db.child("auths").child(source).child(uid).set("none")
    return 'added'

def remove_firebase_entry(source,uid):
    db.child("auths").child(source).child(uid).remove()
    return 'removed'

def get_firebase_entry(source,uid):
    return db.child("auths").child(source).child(uid).get().val()


@app.route('/')
def index():
    return '''<pre>

        use
        /login/website/email
        to make Request
        and check the response at
        /check/website/email
        </pre>
    '''

# Here goes the code for the rest of the pages

@app.route('/login/<source>/<uid>')
def login(source="",uid=""):
    add_firebase_entry(source,uid)
    #send notification to app
    return 'Request Made goto check url now'


@app.route('/check/<source>/<uid>')
def check(source="",uid=""):
    #check firebase
    return get_firebase_entry(source,uid)


@app.errorhandler(404)
def page_not_found(e):
    return render_template('error.html', errorcode=404)

if __name__ == "__main__":
    app.run(host='0.0.0.0', port=8080, debug=True, threaded=True)
