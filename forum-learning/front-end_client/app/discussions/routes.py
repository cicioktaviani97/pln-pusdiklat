from flask import Blueprint, render_template

discussions = Blueprint('discussions', __name__, template_folder='templates', url_prefix='/discussions')

# default top timeline
@discussions.route('/')
@discussions.route('/timeline')
def top_timeline():
    return render_template("discussions/top_timeline.html")

@discussions.route('/discussion/<string:discussions_id>')
def user_discussion(discussions_id):
    return render_template('/discussions/user_discussion.html', discussions_id=discussions_id)