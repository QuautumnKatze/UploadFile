import cv2
video = cv2.VideoCapture(r'D:\Study\[Ky 1 2024-2025]\Opencv\Tutorial\video\triorun.mp4')
fps = video.get(cv2.CAP_PROP_FPS)
totalFrames = video.get(cv2.CAP_PROP_FRAME_COUNT)
print('Số khung hình trên giây: {}, tổng số khung hình {}'.format(fps, totalFrames))
while True:
    ret, frame = video.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    cv2.imshow('Play', gray)
    if cv2.waitKey(10) == ord('s'):
        cv2.imwrite("saved_frame.jpg", gray)
    if cv2.waitKey(10) == ord('q'): break
video.release()
cv2.destroyAllWindows()